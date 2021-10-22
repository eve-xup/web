<?php

namespace Xup\Web;


use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

use Xup\Web\Components\Livewire\Modals\Acl\AddRole;

class LivewireServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Livewire::component('xup.acl.add-role', AddRole::class);
    }
}