<?php

namespace Xup\Web\Http\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;


class Navigation extends AbstractMenu
{

    public function compose(View $view)
    {

        $menu = config('xup.navigation.application');

        ksort($menu);


        $view->with('menu', collect($menu)->map(function ($menu_data, $package) {

            return $this->load_plugin_menu($package, $menu_data);
        })->filter(function ($entry) {
            if (!is_null($entry))
                return $entry;
        })->groupBy('group', true)
            ->sortKeys()
            ->toArray());

    }

    /**
     * Required keys for the route
     * @return string[]
     */
    public function getRequiredKeys(): array
    {
        return [
            'label', 'icon',
        ];
    }

    /**
     * Returns if user has permission or not
     * @param array $permissions
     * @return bool
     */
    public function userHasPermission(array $permissions): bool
    {
        return Gate::any($permissions);
    }
}