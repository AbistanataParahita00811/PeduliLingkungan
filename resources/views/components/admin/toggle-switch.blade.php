@props(['url' => '#', 'checked' => false, 'label' => ''])
<form action="{{ $url }}" method="POST" class="inline">
    @csrf
    @method('PATCH')
    <button
        type="submit"
        role="switch"
        aria-checked="{{ $checked ? 'true' : 'false' }}"
        @class([
            'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-leaf focus:ring-offset-2',
            'bg-leaf' => $checked,
            'bg-gray-200' => !$checked,
        ])
    >
        <span
            @class([
                'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                'translate-x-5' => $checked,
                'translate-x-1' => !$checked,
            ])
        ></span>
    </button>
    @if($label)
        <span class="ml-2 text-sm text-gray-600">{{ $label }}</span>
    @endif
</form>
