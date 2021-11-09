@extends('web::layouts.grids.12')

@section('full')
    @livewire('livewire-web::fleet.manage', ['fleet'=>$fleet])
@stop