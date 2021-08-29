<?php

namespace Xup\Web\Http\Controllers;

use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{

    public function index(){

        return view('web::welcome');

    }

}