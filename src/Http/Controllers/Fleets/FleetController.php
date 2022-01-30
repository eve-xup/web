<?php

namespace Xup\Web\Http\Controllers\Fleets;

use Illuminate\Routing\Controller;
use Xup\Core\Jobs\Fleet\JoinFleet;
use Xup\Core\Models\Fleets\Fleet;


class FleetController extends Controller
{

    public function index()
    {
        //Check for existing fleets
        return view('xup::fleets.create');
    }


    public function manage(Fleet $fleet)
    {
        return view('xup::fleets.manage', compact('fleet'));
    }

    public function join(Fleet $fleet)
    {
       return view('xup::fleets.join-fleet', compact('fleet'));
    }

}
