@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-cyan-500/50 focus:border-cyan-400 focus:ring-cyan-500 rounded-md shadow-sm']) }}>
