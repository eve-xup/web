@extends('xup::layouts.grids.4-4-4')

@section('left')
    @livewire('livewire-xup::fleet.settings', ['fleet'=>$fleet])

    @livewire('livewire-xup::fleet.member-summary', ['fleet'=>$fleet])
@stop
