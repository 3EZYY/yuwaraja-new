@props(['active', 'href'])

@php
$classes = ($active ?? false)
    ? 'flex items-center px-4 py-2 text-cyan-400 bg-cyan-400/10 rounded-lg transition-colors duration-200'
    : 'flex items-center px-4 py-2 text-gray-400 hover:text-cyan-400 hover:bg-cyan-400/10 rounded-lg transition-colors duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes, 'href' => $href]) }}>
    @if (isset($icon))
        <span class="mr-3">{{ $icon }}</span>
    @endif
    {{ $slot }}
</a>
