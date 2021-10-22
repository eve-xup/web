
<x-form id="role-form" method="{{ $method ?? 'POST' }}" action="{{ $action ?? route('settings.acl.store') }}">

    <x-form-group label="Role Title" name="role[title]" inline :border="false" class="text-white font-light">
        <x-input name="role[title]" placeholder="Role title" value="{{ isset($role) ? $role->title : '' }}"></x-input>
    </x-form-group>

    <x-form-group label="Description" name="role[description]" inline :border="false" class="text-white font-light">
        <x-textarea name="role[description]" placeholder="Description of role" value="{{ isset($role) ? $role->description : '' }}"></x-textarea>
    </x-form-group>
</x-form>