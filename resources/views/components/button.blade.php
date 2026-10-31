@props(['variant' => 'primary', 'href' => null, 'type' => 'button'])

@php
    $classes = [
        'inline-flex items-center justify-center gap-2 rounded-lg px-4 py-2 text-sm font-semibold shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2',
        match ($variant) {
            'secondary' => 'border border-zinc-300 bg-white text-zinc-800 hover:bg-zinc-100 focus-visible:outline-indigo-600 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100 dark:hover:bg-zinc-800',
            'success' => 'bg-emerald-600 text-white hover:bg-emerald-700 focus-visible:outline-emerald-600',
            'danger' => 'bg-red-600 text-white hover:bg-red-700 focus-visible:outline-red-600',
            'ghost' => 'text-indigo-700 shadow-none hover:bg-indigo-50 focus-visible:outline-indigo-600 dark:text-indigo-300 dark:hover:bg-indigo-950',
            default => 'bg-indigo-600 text-white hover:bg-indigo-700 focus-visible:outline-indigo-600',
        },
    ];
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->class($classes) }}>{{ $slot }}</button>
@endif
