@props(['name' => 'image', 'existingUrl' => null])
<div x-data="{ preview: '{{ $existingUrl ?? '' }}' }">
    <input
        type="file"
        name="{{ $name }}"
        accept="image/*"
        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-forest file:text-white file:cursor-pointer hover:file:bg-moss"
        @change="
            const file = $event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => preview = e.target.result;
                reader.readAsDataURL(file);
            } else {
                preview = null;
            }
        "
        {{ $attributes->except('class') }}
    >
    <div x-show="preview" class="mt-3" x-cloak>
        <img :src="preview" alt="Preview" class="rounded-lg border border-gray-200 max-h-48 object-cover">
    </div>
</div>
