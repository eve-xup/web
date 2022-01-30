

<x-xup-form id="role-form" method="{{ $method ?? 'POST' }}" action="{{ $action ?? route('settings.acl.store') }}">


    <x-xup-form-group label="Role Title" name="role[title]" labelClass="text-white">
        <x-xup-input name="role[title]" placeholder="Role title" value="{{ isset($role) ? $role->title : '' }}"></x-xup-input>
    </x-xup-form-group>

    <x-xup-form-group label="Description" name="role[description]" labelClass="text-white">
        <x-xup-input name="role[description]" placeholder="Description of role" value="{{ isset($role) ? $role->description : '' }}"></x-xup-input>
    </x-xup-form-group>

</x-xup-form>
