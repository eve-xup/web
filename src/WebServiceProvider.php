<?php

namespace Xup\Web;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Xup\Web\Http\Composers\Users;

class WebServiceProvider extends ServiceProvider
{

    public function boot(){

        $this->add_routes();

        $this->add_views();

        $this->add_publications();

        $this->add_view_composers();

    }

    public function register(){

    }


    public function add_routes(){
        $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
    }

    public function add_views(){
        $this->loadViewsFrom(__DIR__. '/resources/views', 'web');
    }

    private function add_publications(){
        $this->publishes([
            __DIR__ . '/resources/css' => public_path('web/css'),
            __DIR__ . '/resources/images/' => public_path('web/images')
        ], ['config', 'xup']);
    }

    private function add_view_composers(){

        View::composer('web::includes.navbar', Users::class);

    }
}