@extends('xup::layouts.grids.3-6-3')

@section('middle')

    <div class="bg-gray-600 p-4 rounded shadow-md bg-opacity-50">
        <h1 class="text-xl font-bold text-gray-200">Creating a fleet</h1>
        <ul class="text-gray-200">
            <li>1. Create a fleet in-game on one of your characters</li>
            <li>2. Return to this page, and select your character below</li>
            <li>3. Give the fleet a title, and register your fleet.</li>
        </ul>
    </div>

    <div class="bg-gray-800 p-4 rounded shadow-md mt-2">

        @livewire('livewire-web::fleet.create')

    </div>

@endsection
