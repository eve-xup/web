<?php

namespace Xup\Web\Http\Controllers\Fleets;

use Illuminate\Routing\Controller;
use Xup\Core\Models\Fleets\Fleet;


class FleetController extends Controller
{

    public function index(){
        //Check for existing fleets
        return view('web::fleets.create');
    }


    public function manage(){

        try{
            $fleet = Fleet::InFleet()->firstOrFail();
            return view('web::fleets.manage', compact('fleet'));
        }catch(\Exception $e){
            return redirect(route('home'))->with('error', 'None of your registered characters are currently in a fleet');
        }

    }

}