@extends('xup::layouts.grids.4-8')

@section('before_page')
    @include('xup::Settings.roles.navigation')
@stop

@section('left')
    <div class="rounded-md w-full shadow-md bg-gray-800">
        <div class="border-b px-4 py-2 border-b-2 text-white">
            Create New Role
        </div>
        <div class="p-4">

            @include('xup::Settings.roles.partials.role-form', ['action' => route('settings.acl.users', ['role'=>$role]), 'method'=>'PUT'])

        </div>

        <div class="p-4 flex justify-end">

            <button form="role-form"
                    class="px-4 py-2 bg-cyan-800 text-white rounded shadow-lg hover:bg-cyan-700 active:bg-cyan-900">
                Update Role
            </button>

        </div>

    </div>
@stop


@section('right')
    <div class="rounded-md w-full shadow-md bg-gray-800">
        <div class="border-b px-4 py-2 border-b-2 text-white">
            Manage Users
        </div>
        <div class="p-4">
            @livewire('xup-web::settings.role.users', ['role'=>$role])
        </div>
    </div>

@endsection
