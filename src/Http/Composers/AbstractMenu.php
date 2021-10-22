<?php

namespace Xup\Web\Http\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Xup\Web\Exceptions\MenuBuilderException;

abstract class AbstractMenu
{

    abstract public function compose(View $view);

    abstract public function getRequiredKeys(): array;

    abstract public function userHasPermission(array $permissions): bool;


    protected function hasRequiredPermissions($options): bool
    {
        $permissions = Arr::get($options, 'permissions', []);
        $permissions = is_array($permissions) ? $permissions : [$permissions];
        if(array_key_exists('entries', $options)){
            $permissions = array_merge($permissions,
                collect($options['entries'])->pluck('permissions')->flatten()->toArray(),
            );
        }

        return $this->userHasPermission($permissions) || count($permissions) === 0;
    }


    /**
     * @throws MenuBuilderException
     */
    public function load_plugin_menu(string $scope, array $menu_data): ?array
    {
        $this->validate_menu($scope, $menu_data);

        return $this->hasRequiredPermissions($menu_data) ? $menu_data : null;
    }

    /**
     * @throws MenuBuilderException
     */
    public function validate_menu(string $scope, array $menu_data)
    {


        if(! is_string($scope))
            throw new MenuBuilderException("Scope name should be named by string");


        if(! is_array($menu_data))
            throw new MenuBuilderException("Package menu should be defined as an array");



        $this->CheckForRequiredKeys($this->getRequiredKeys(), $menu_data, $scope);



        if(!array_key_exists('entries', $menu_data) && !array_key_exists('route', $menu_data))
            throw new MenuBuilderException("Must define entries for submenu or route for destination");

        if(array_key_exists('entries', $menu_data) && !is_array($menu_data['entries']))
            throw new MenuBuilderException('Entries must be an array');

        if(isset($menu_data['entries'])){
            foreach($menu_data['entries'] as $entry){
                $this->CheckForRequiredKeys($this->getRequiredKeys(), $entry, 'sub menu');

            }
        }
    }


    /**
     * Checks menu entries have the required keys
     * @param $required
     * @param $menu
     * @param string $level
     * @throws MenuBuilderException
     */
    public function CheckForRequiredKeys($required, $menu, $scope)
    {
        foreach($required as $key){
            if(!array_key_exists($key, $menu)){
                throw new MenuBuilderException(
                    sprintf("Error in menu definition for %s. Missing '%s' key", $scope, $key)
                );
            }
        }
    }

}