<?php


namespace Xup\Web\Http\Components\Livewire\Fleet;

use Livewire\Component;
use Xup\Core\Jobs\Fleet\JoinFleet;
use Xup\Core\Models\Fleets\Fleet;

class JoinFleetCharacterList extends Component
{
    public Fleet $fleet;

    public function getAvailableCharactersProperty(){
        return auth()->user()->characters;
    }

    public function invite_character($character_id){
        JoinFleet::dispatch($this->fleet, $character_id);
    }

    public function inviteAll(){
        $this->getAvailableCharactersProperty()
            ->each(function($character){
                $this->invite_character($character->character_id);
            });
    }

    public function render(){
        return view('xup::livewire.fleet.join-character-list');
    }
}
