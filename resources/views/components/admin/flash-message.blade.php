@props(['type' => 'success'])
<div
    {{ $attributes->merge(['class' => 'flex items-center gap-3 rounded-lg px-4 py-3 border ' . ($type === 'success' ? 'bg-green-50 border-green-200 text-green-800' : 'bg-red-50 border-red-200 text-red-800')]) }}
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 3000)"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
>
    @if($type === 'success')
        <x-icons name="check-circle" class="w-5 h-5 flex-shrink-0" />
    @else
        <x-icons name="x-circle" class="w-5 h-5 flex-shrink-0" />
    @endif
    <p class="flex-1 text-sm font-medium">{{ $slot }}</p>
    <button type="button" @click="show = false" class="p-1 hover:bg-black/5 rounded">
        <x-icons name="x-mark" class="w-4 h-4" />
    </button>
</div>
