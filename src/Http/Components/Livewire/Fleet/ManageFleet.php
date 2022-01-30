<?php

namespace Xup\Web\Http\Components\Livewire\Fleet;

use Livewire\Component;

class ManageFleet extends Component
{

    public $fleet;

    public function render(){
        return view('xup::livewire.fleet.manage-fleet');
    }
}
