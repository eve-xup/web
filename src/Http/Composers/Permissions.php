<?php

namespace Xup\Web\Http\Composers;

use Illuminate\Contracts\View\View;

class Permissions
{

    public function compose(View $view)
    {
        $permission_scopes = collect(config('xup.permissions'))->sortKeys();

        $view->with(compact('permission_scopes'));
    }
}