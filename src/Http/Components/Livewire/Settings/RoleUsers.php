<?php

namespace Xup\Web\Http\Components\Livewire\Settings;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;
use Xup\Core\Models\Access\Role;
use Xup\Core\Models\Character\Character;
use Xup\Core\Models\User;


class RoleUsers extends Component
{

    public Role $role;

    public $user_search = '';

    /**
     * @var Collection
     */
    public $selected_users;

    /**
     * @var Collection
     */
    public $user_list;

    public function mount()
    {
        $this->user_list = User::with('characters', 'main_character')->get();
        $this->selected_users = $this->role->users()->with('characters', 'main_character')->get();
    }


    public function render()
    {
        return view('web::components.livewire.settings.role-users');
    }

    public function getAvailableUsersProperty()
    {
        return $this->user_list
            ->filter(function (User $user) {
                if ($this->user_search === '') {
                    return true;
                }
                return $user->characters->filter(function (Character $character) {
                        return Str::contains($character->name, [$this->user_search]);
                    })->count() > 0;
                /*return trim($this->selected_users) == '' ??
                    $user->characters->filter(function (Character $character) {
                        return Str::contains($character->name, [$this->user_search]);
                    })->count() > 0;*/
            });
        /*->diff($this->selected_users)
        ->filter(function(User $user){
           return $user->characters->filter(function(Character $character){
                return Str::contains($character->name, [$this->user_search]);
           })->count() > 0;
        });*/
    }


}