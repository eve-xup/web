<?php


namespace Xup\Web\Http\Components\Livewire\Fleet;


use Livewire\Component;
use Xup\Core\Chains\UpdateFleet;
use Xup\Core\Jobs\Fleet\GetFleetMembers;
use Xup\Core\Models\Fleets\Fleet;

class FleetSettings extends Component
{
    public Fleet $fleet;

    public bool $fleetSyncing = false;


    protected $rules = [
        'fleet.title' => 'required|string|min:4',
        'fleet.is_free_move' => 'boolean',
        'fleet.invite_mode' => 'required',
        'fleet.kick_unregistered' => 'boolean',
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function updateFleet(){
        $this->fleet->save();
    }

    protected function getListeners()
    {
        return [
            "echo-private:fleet.{$this->fleet->fleet_id},fleet.synced" => "fleetSynced"
        ];
    }

    public function fleetSynced(){
        $this->fleet->fresh();

        $this->fleetSyncing = false;
    }

    public function syncFleet(){
        $this->fleetSyncing = true;

        GetFleetMembers::dispatch($this->fleet);
    }


    public function render(){
        return view('xup::livewire.fleet.settings');
    }
}
