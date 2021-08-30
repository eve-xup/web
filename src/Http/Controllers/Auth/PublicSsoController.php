<?php

namespace Xup\Web\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Contracts\Factory as Socialite;
use LaravelEveTools\EveApi\Models\RefreshToken;
use SocialiteProviders\Manager\OAuth2\User as SocialiteUser;
use Xup\Core\Models\Character\Character;
use Xup\Core\Models\User;

class PublicSsoController extends Controller
{

    protected $scopes = ['publicData'];

    public function redirect(Socialite $social){
        return $social->driver('eveonline')
            ->scopes($this->scopes)
            ->redirect();
    }


    public function callback(Socialite $social){

        $eve_data = $social->driver('eveonline')
            ->scopes($this->scopes)
            ->user();

        $user = $this->findOrCreateUser($eve_data);

        $this->updateRefreshToken($eve_data, $user);

        $this->getCharacterDetails($eve_data);


        if(!auth()->check())
            auth()->login($user);

        return redirect()->intended('/home');
    }


    private function findOrCreateUser(SocialiteUser $eve_user){

        RefreshToken::where('character_id', $eve_user->id)
            ->where('character_owner_hash', '<>', $eve_user->character_owner_hash)
            ->whereNull('deleted_at')
            ->delete();

        $user = User::whereHas('refresh_tokens', function($query) use($eve_user){
            $query->where('character_id', $eve_user->id)
                ->where('character_owner_hash', '=', $eve_user->character_owner_hash)
                ->whereNull('deleted_at');
        })->first();

        if(auth()->check()){
            if(!is_null($user) && auth()->user()->id !== $user->id){
                RefreshToken::where('character_id', $eve_user->id)
                    ->where('user_id', $user->id)
                    ->delete();
            }
            $user = auth()->user();
        }

        if($user)
            return $user;

        event('security.log', [
            'Creating new Account for '. $eve_user->name, 'authentication'
        ]);

        $user = User::firstOrCreate([
            'main_character_id' => $eve_user->id,
        ]);
        $user->save();
        return $user;
    }

    private function updateRefreshToken(SocialiteUser $eve_user, User $xup_user){
        RefreshToken::withTrashed()->where('character_id', $eve_user->id)
            ->where('character_owner_hash', '<>', $eve_user->character_owner_hash)
            ->delete();

        RefreshToken::withTrashed()->firstOrNew([
            'character_id'          => $eve_user->id
        ], [
            'user_id'               => $xup_user->getKey(),
            'refresh_token'         => $eve_user->refreshToken,
            'scopes'                => $eve_user->scopes,
            'token'                 => $eve_user->token,
            'character_owner_hash'  => $eve_user->character_owner_hash,
            'expires_on'            => $eve_user->expires_on,
            'version'               => RefreshToken::CURRENT_VERSION,
        ])->save();

        RefreshToken::onlyTrashed()
            ->where('character_id', $eve_user->id)
            ->where('user_id', $xup_user->id)
            ->restore();
    }

    /**
     * Create The Character model and queue the job to fetch his details.
     * @param SocialiteUser $eve_user
     */
    private function getCharacterDetails(SocialiteUser $eve_user)
    {
        Character::firstOrCreate([
            'character_id'  => $eve_user->id,
        ], [
            'name'          => $eve_user->name,
        ]);

        //This will fetch the corporation and alliance of the character as well.
        \Xup\Core\Jobs\Character\Character::dispatch($eve_user->id);
    }


}