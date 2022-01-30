<?php


namespace Xup\Web\Http\Components\Livewire\Fleet;


use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Xup\Core\Jobs\Fleet\KickMember;
use Xup\Core\Jobs\Fleet\RemoveUnregisteredMembers;
use Xup\Core\Models\Fleets\Fleet;
use Xup\Core\Models\Fleets\FleetMember;
use Xup\Core\Models\User;

class MemberSummary extends Component
{

    public Fleet $fleet;


    public function getMembersProperty(){
        return FleetMember::fleet($this->fleet->fleet_id)
            ->with('character.user.main_character')->get();
    }

    public function clearNonInvites(){
        RemoveUnregisteredMembers::dispatch($this->fleet);
    }

    public function kickMember($character_id){
        KickMember::dispatch($this->fleet->fleet_id, $character_id, $this->fleet->fleet_boss->refresh_token);
    }

    public function render(){
        return view('xup::livewire.fleet.member-summary');
    }

}
