@extends('xup::layouts.grids.3-6-3')

@section('middle')
    <x-xup-card class="bg-gray-600">
        <div class="px-4 py-2">
            <h1 class="text-xl text-white">
                Which characters to join {{$fleet->name}}
            </h1>
        </div>
        <div class="p-4">
            @livewire('livewire-xup::fleet.invite-characters', ['fleet'=>$fleet])
        </div>
    </x-xup-card>

@stop
