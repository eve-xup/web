<button {{ $attributes->merge(['class'=>'px-4 py-2 rounded shadow bg-sky-600 text-sky-100 hover:bg-sky-700 hover:text-sky-200 active:bg-sky-800']) }}>
    {{ $slot }}
</button>
