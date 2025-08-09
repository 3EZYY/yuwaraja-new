@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-cyan-700']) }}>
    {{ $value ?? $slot }}
</label>
