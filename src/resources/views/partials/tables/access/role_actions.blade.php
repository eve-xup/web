<div class="flex space-x-2 justify-center">
    <a href="{{ route('settings.acl.edit', ['role'=>$role]) }}"
       class="rounded-md shadow-md px-4 py-2 flex items-center bg-yellow-500 hover:bg-yellow-400 active:bg-yellow-600 ">
        @svg('heroicon-o-pencil', 'h-4 w-4')
        Edit
    </a>

    @can('acl.delete')
        <x-xup-form id="delete-role-{{$role->getKey()}}" method="DELETE" action="{{ route('settings.acl.delete', ['role'=>$role]) }}">

        </x-xup-form>
        <button form="delete-role-{{$role->getKey()}}"
           class="rounded-md shadow-md px-4 py-2 flex items-center bg-red-500 hover:bg-red-400 active:bg-red-600 ">
            @svg('heroicon-o-trash', 'h-4 w-4')
            Delete
        </button>
    @endif
</div>
