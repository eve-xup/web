<?php

namespace Xup\Web;


use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Xup\Web\Http\Components\Livewire\Settings\RoleUsers;


class LivewireServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Livewire::component('xup-web::settings.role.users', RoleUsers::class);
    }
}