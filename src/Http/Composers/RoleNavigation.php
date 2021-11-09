<?php

namespace Xup\Web\Http\Composers;


use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;

class RoleNavigation extends AbstractMenu
{


    public function compose(View $view)
    {
        $menu = config('xup.navigation.acl', []);

        $view->with(compact('menu'));
    }

    public function getRequiredKeys(): array
    {
        return ['label', 'route'];
    }

    public function userHasPermission(array $permissions): bool
    {
        return Gate::any($permissions);
    }
}