<?php

namespace Xup\Web;


use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Livewire\Livewire;
use Xup\Core\AbstractPluginProvider;
use Xup\Web\Acl\Policies\GlobalPolicy;
use Xup\Web\Http\Components\Livewire\Datatables\Access\RolesDatatable;


class WebServiceProvider extends AbstractPluginProvider
{

    public function boot(){

        $this->add_routes();

        $this->add_views();

        $this->add_publications();

        $this->add_view_composers();

        $this->add_livewire_components();


    }

    public function register(){
        //$this->registerNavGroups(__DIR__.'/Config/navigation.groups.php');
        $this->registerNavigation(__DIR__.'/Config/navigation.navbar.php');
        $this->registerPermissions(__DIR__ .'/Config/permissions/acl.permissions.php', 'acl');
        $this->registerPermissions(__DIR__ .'/Config/permissions/fleet-commander.permissions.php', 'xup');

        $this->register_authorization();
    }

    public function add_livewire_components(){

        Livewire::component('livewire-web::acl.roles-table', RolesDatatable::class);
    }


    public function add_routes(){
        $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
    }

    public function add_views(){
        $this->loadViewsFrom(__DIR__. '/resources/views', 'web');
    }

    private function add_publications(){
        $this->registerCSSFile('web/css/web.css');
        $this->publishes([
            __DIR__ . '/resources/css' => public_path('web/css'),
            __DIR__ . '/resources/images/' => public_path('web/images')
        ], ['config', 'xup']);
    }

    private function add_view_composers(){

        View::composer('web::includes.sidebar.sidebar', \Xup\Web\Http\Composers\Users::class);
        app('view')->composer([
            'web::includes.sidebar.sidebar',
        ], \Xup\Web\Http\Composers\Navigation::class);

        app('view')->composer([
            'web::Settings.AccessList.partials.permission-list'
        ], \Xup\Web\Http\Composers\Permissions::class);

    }

    public function register_authorization(){
        $permissions = $this->getPermissions();

        foreach($permissions as $scope => $scope_permission){
            foreach($scope_permission as $permission=> $definition){
                $ability = sprintf('%s.%s', $scope, $permission);

                $policy = GlobalPolicy::class;

                Gate::define($ability, sprintf('%s@%s', $policy, $permission));
            }
        }
    }
}