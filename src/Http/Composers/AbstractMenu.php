<?php

namespace Xup\Web\Http\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Xup\Web\Concerns\Handler;
use Xup\Web\Exceptions\InvalidMenuParameterException;
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
        if (array_key_exists('entries', $options)) {
            $permissions = array_merge($permissions,
                collect($options['entries'])->pluck('permissions')->flatten()->toArray(),
            );

        }

        return count($permissions) === 0 || $this->userHasPermission($permissions);
    }


    /**
     * @throws MenuBuilderException
     * @throws InvalidMenuParameterException
     */
    public function load_plugin_menu(string $scope, array $menu_data): ?array
    {
        $this->validate_menu($scope, $menu_data);

        $menu = $this->hasRequiredPermissions($menu_data) ? $menu_data : null;

        if (is_null($menu)) {
            return null;
        }

        $menu = $this->generateUrls($menu);


        return $menu;
    }

    /**
     * @param array $menu
     * @return array|null
     * @throws InvalidMenuParameterException
     */
    protected function generateUrls(array $menu): array
    {


        if (Arr::exists($menu, 'entries')) {
            foreach ($menu['entries'] as $key => $item) {
                $menu['entries'][$key] = $this->generateUrls($item);
            }
        }

        if (!Arr::exists($menu, 'route')) {
            return $menu;
        }

        $params = [];
        foreach (Arr::get($menu, 'parameters', []) as $parameter => $handlerClass) {
            $handler = new $handlerClass;
            if (!($handler instanceof Handler)) {
                throw new InvalidMenuParameterException("$handler does not implement " . Handler::class);
            }
            $params[$parameter] = $handler->handle();
        }
        $menu['url'] = route($menu['route'], $params);

        return $menu;
    }

    /**
     * @throws MenuBuilderException
     */
    public function validate_menu(string $scope, array $menu_data)
    {


        if (!is_string($scope))
            throw new MenuBuilderException("Scope name should be named by string");


        if (!is_array($menu_data))
            throw new MenuBuilderException("Package menu should be defined as an array");


        $this->CheckForRequiredKeys($this->getRequiredKeys(), $menu_data, $scope);


        if (!array_key_exists('entries', $menu_data) && !array_key_exists('route', $menu_data))
            throw new MenuBuilderException("Must define entries for submenu or route for destination");

        if (array_key_exists('entries', $menu_data) && !is_array($menu_data['entries']))
            throw new MenuBuilderException('Entries must be an array');

        if (isset($menu_data['entries'])) {
            foreach ($menu_data['entries'] as $entry) {
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
        foreach ($required as $key) {
            if (!array_key_exists($key, $menu)) {
                throw new MenuBuilderException(
                    sprintf("Error in menu definition for %s. Missing '%s' key", $scope, $key)
                );
            }
        }
    }

}
