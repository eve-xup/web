<?php

namespace Xup\Web\Http\Components\Livewire\Fleet;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Component;
use Xup\Core\Jobs\Character\Fleet as FindFleet;
use Xup\Core\Models\Character\Character;
use Xup\Core\Models\Fleets\Fleet;
use Xup\Core\Models\Fleets\FleetInvitation;

class CreateFleet extends Component
{

    public Collection $available_characters;

    public string $character_search = '';

    public $fleet_id = null;

    public $selected_character;

    //Error Message
    public $message;

    public $title = null;


    protected $rules = [
        'title' => 'required',
        'fleet_id'=> 'required',
    ];

    public function mount(){
        $this->available_characters = auth()->user()->characters;
    }


    public function updated($propertyName){
        if($propertyName == 'fleet_title'){
            $this->validateOnly($propertyName);
        }
    }

    public function CreateFleet(){
        $validatedData = $this->validate();

        $fleet = Fleet::create(array_merge($validatedData, [
            'boss_id'=>$this->selected_character->getKey()
        ]));

        FleetInvitation::create([
            'fleet_id'=>$fleet->fleet_id,
            'character_id' => $this->selected_character->getKey()
        ]);

        if($fleet)
            return redirect(route('xup.fleets.current'));
    }



    /**
     * Filter collection of characters based on name
     * @return Collection
     */
    public function getCharactersProperty(): Collection
    {
        return $this->available_characters->filter(function(Character  $character){
            if(trim($this->character_search) == ''){
                return true;
            }
            return Str::contains($character->name, [$this->character_search]);
        });
    }

    /**
     * Select an availalble character from the list and search for their fleet from ESI
     * @param $character_id
     */
    public function selectCharacter($character_id){
        $this->selected_character = $this->available_characters->find($character_id);
        $this->SearchForFleet();
    }

    /**
     * Query the ESI for the fleet this character is in
     */
    public function SearchForFleet(){
        $this->fleet_id = null;
        try{
            $fleet = new FindFleet($this->selected_character->refresh_token);
            $fleet->handle();
            $this->fleet_id = Arr::get($fleet->getResponse(), 'fleet_id', null);
            if(empty(trim($this->title))){
                $this->title = Str::plural($this->selected_character->name).' Fleet';
            }
        }catch(\Exception $e){
            $this->message = $e->getMessage();
        }
    }


    public function render(){
        return view('web::components.livewire.fleet.create-fleet');
    }

}