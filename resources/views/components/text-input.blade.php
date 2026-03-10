@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border border-moss/20 rounded-xl focus:border-leaf focus:ring-leaf bg-white transition-all duration-300']) }}>
