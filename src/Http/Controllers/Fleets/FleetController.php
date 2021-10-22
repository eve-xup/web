<?php

namespace Xup\Web\Http\Controllers\Fleets;

use Illuminate\Routing\Controller;

class FleetController extends Controller
{

    public function index(){
        return view('web::fleets.create');
    }

}