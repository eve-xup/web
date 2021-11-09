@extends('web::layouts.grids.4-8')

@section('before_page')
    @include('web::Settings.roles.navigation')
@stop

@section('left')
    <div class="rounded-md w-full shadow-md bg-gray-800">
        <div class="border-b px-4 py-2 border-b-2 text-white">
            Create New Role
        </div>
        <div class="p-4">

            @include('web::Settings.roles.partials.role-form', ['action' => route('settings.acl.edit', ['role'=>$role]), 'method'=>'PUT'])

        </div>

        <div class="p-4 flex justify-end">

            <button form="role-form" class="px-4 py-2 bg-cyan-800 text-white rounded shadow-lg hover:bg-cyan-700 active:bg-cyan-900">
                Update Role
            </button>

        </div>

    </div>
@stop


@section('right')
    @include('web::Settings.roles.partials.permission-list')
@endsection