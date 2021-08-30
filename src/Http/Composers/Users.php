<?php

namespace Xup\Web\Http\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class Users
{

    public function compose(View $view)
    {
        $view->with('user', Auth::user());
    }

}