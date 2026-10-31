@props(['href', 'active' => false])

<a href="{{ $href }}"
   @if ($active) aria-current="page" @endif
   {{ $attributes->class([
       'rounded-lg px-3 py-2 text-sm font-medium focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600',
       'bg-indigo-50 text-indigo-700 dark:bg-indigo-950 dark:text-indigo-200' => $active,
       'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white' => ! $active,
   ]) }}>
    {{ $slot }}
</a>
