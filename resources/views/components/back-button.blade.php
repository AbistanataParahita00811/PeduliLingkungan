@props(['href' => null, 'label' => 'Kembali'])

<a
    href="{{ $href ?? url()->previous() }}"
    class="inline-flex items-center gap-2 text-sm text-muted hover:text-forest transition-colors mb-6 group"
>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
         stroke-width="1.5" stroke="currentColor"
         class="w-4 h-4 group-hover:-translate-x-1 transition-transform">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
    </svg>
    {{ $label }}
</a>

