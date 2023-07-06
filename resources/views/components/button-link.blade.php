@props(['route', 'text', 'color'])

@php
    $classes = 'bg-'.$color.'-500 hover:bg-'.$color.'-700 text-white font-bold py-2 px-4 rounded'
@endphp

<a href="{{ $route }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $text }}
</a>