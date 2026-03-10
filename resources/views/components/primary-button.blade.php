<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-2.5 bg-lime text-forest font-semibold rounded-md focus:outline-none focus:ring-2 focus:ring-leaf focus:ring-offset-2 transition-all duration-300 hover:bg-leaf']) }}>
    {{ $slot }}
</button>
