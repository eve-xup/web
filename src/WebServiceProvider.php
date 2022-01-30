<?php

namespace Xup\Web;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;
use Xup\Core\AbstractPluginProvider;
use Xup\Web\Acl\Policies\GlobalPolicy;
use Xup\Web\Actions\Cache\UserCurrentFleet;
use Xup\Web\Http\Components\Livewire\Datatables\Access\RolesDatatable;
use Xup\Web\Http\Components\Livewire\Fleet\CreateFleet;
use Xup\Web\Http\Components\Livewire\Fleet\FleetSettings;
use Xup\Web\Http\Components\Livewire\Fleet\JoinFleetCharacterList;
use Xup\Web\Http\Components\Livewire\Fleet\ManageFleet;
use Xup\Web\Http\Components\Livewire\Fleet\MemberSummary;



class WebServiceProvider extends AbstractPluginProvider
{

    public function boot(){

        $this->add_routes();

        $this->add_views();

        $this->add_publications();

        $this->add_view_composers();

        $this->add_livewire_components();

        $this->configureComponents();

        $this->registerBroadcastChannels();
    }

    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('form');
            $this->registerComponent('form-group');
            $this->registerComponent('input');
            $this->registerComponent('select');
            $this->registerComponent('text-field');
            $this->registerComponent('checkbox');
            $this->registerComponent('card');

            $this->registerComponent('character.avatar');
            $this->registerComponent('character.display');

            //Buttons
            $this->registerComponent('buttons.primary');

            //links
            $this->registerComponent('link.primary');
        });
    }

    public function registerComponent(string $component){
        Blade::component('xup::components.'.$component, 'xup-'.$component);
    }

    public function register(){
        $this->registerNavigation(__DIR__.'/Config/navigation.navbar.php');
        $this->registerPermissions(__DIR__ .'/Config/permissions/acl.permissions.php', 'acl');
        $this->registerPermissions(__DIR__ .'/Config/permissions/fleet-commander.permissions.php', 'xup');

        $this->mergeConfigFrom(__DIR__.'/Config/acl.navigation.php', 'xup.navigation.acl');

        $this->register_authorization();
    }

    public function add_livewire_components(){

        Livewire::component('livewire-web::acl.roles-table', RolesDatatable::class);
        Livewire::component('livewire-web::fleet.create', CreateFleet::class);
        Livewire::component('livewire-web::fleet.manage', ManageFleet::class);
        Livewire::component('livewire-xup::fleet.settings', FleetSettings::class);
        Livewire::component('livewire-xup::fleet.member-summary', MemberSummary::class);
        Livewire::component('livewire-xup::fleet.invite-characters', JoinFleetCharacterList::class);
    }


    public function add_routes(){
        $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
    }

    public function add_views(){
        $this->loadViewsFrom(__DIR__. '/resources/views', 'xup');
    }

    private function add_publications(){
        $this->registerCSSFile('web/css/web.css');
        $this->publishes([
            __DIR__ . '/resources/css' => public_path('web/css'),
            __DIR__ . '/resources/images/' => public_path('web/images')
        ], ['config', 'xup']);
    }

    private function add_view_composers(){

        View::composer('xup::includes.sidebar.sidebar', \Xup\Web\Http\Composers\Users::class);

        app('view')->composer([
            'xup::includes.sidebar.sidebar',
        ], \Xup\Web\Http\Composers\Navigation::class);

        app('view')->composer([
            'xup::Settings.roles.partials.permission-list'
        ], \Xup\Web\Http\Composers\Permissions::class);

        app('view')->composer([
            'xup::Settings.roles.navigation'
        ], \Xup\Web\Http\Composers\RoleNavigation::class);

        app('view')->composer([
            'xup::fleets.fleet-list'
        ], \Xup\Web\Http\Composers\FleetList::class);

    }

    public function register_authorization(){
        $permissions = $this->getPermissions();
        foreach($permissions as $scope => $scope_permission){
            foreach($scope_permission as $permission=> $definition){
                $ability = sprintf('%s.%s', $scope, $permission);

                $policy = GlobalPolicy::class;

                if(Arr::exists($definition, 'gate')){
                    $policy = Arr::get($definition, 'gate');

                    //dd($ability, $policy);
                }

                Gate::define($ability, sprintf('%s@%s', $policy, $permission));
            }
        }

    }

    public function registerBroadcastChannels(){
        Broadcast::channel('fleet.{fleetId}', function($user, $fleetId){
            $fleet = (new UserCurrentFleet)->handle();
            return $fleet->fleet_id == $fleetId;
        });
    }
}
