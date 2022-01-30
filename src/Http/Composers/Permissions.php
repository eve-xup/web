<?php

namespace Xup\Web\Http\Composers;

use Illuminate\Contracts\View\View;

class Permissions
{

    public function compose(View $view)
    {
        $permission_scopes = collect(config('xup.permissions'))->sortKeys()->map(function($scope){
            return collect($scope)->filter(function($permission){
                return \Arr::get($permission, 'assignable', true);
            });
        });


        $view->with(compact('permission_scopes'));
    }
}
