<?php

namespace Xup\Web\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Node\Inline\AbstractInline;
use Xup\Core\Models\Character\Character;

class HomeController extends Controller
{

    public function index(){
        return view('web::home');
    }

    public function login(){
        if(Auth::check())
            return redirect(route('home'));

        return view('web::welcome');
    }

    public function setMainCharacter(Character $character){
        $user = \Auth::user();
        $user->main_character_id = $character->getKey();
        $user->save();
        return back();
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}