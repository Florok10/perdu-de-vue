@props(['item', 'showStatus' => false])

<x-card class="flex h-full flex-col gap-3 transition hover:-translate-y-0.5 hover:shadow-md">
    <div class="flex items-start justify-between gap-3">
        <h3 class="font-semibold leading-snug">
            <a href="{{ route('items.show', $item) }}" class="rounded hover:text-indigo-700 hover:underline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:hover:text-indigo-300">
                {{ $item->name }}
            </a>
        </h3>
        <span @class(['mt-1 size-4 shrink-0 rounded-full ring-1 ring-black/20', $item->color->swatchClasses()]) title="{{ $item->color->label() }}" aria-hidden="true"></span>
    </div>

    <p class="text-sm text-zinc-600 dark:text-zinc-400">
        <a href="{{ route('places.show', $item->place) }}" class="rounded font-medium text-zinc-800 hover:underline focus-visible:outline-2 focus-visible:outline-indigo-600 dark:text-zinc-200">{{ $item->place->name }}</a>
        · <time datetime="{{ $item->found_on->toDateString() }}" title="{{ $item->found_on->isoFormat('D MMMM YYYY') }}">trouvé le {{ $item->found_on->isoFormat('D MMMM YYYY') }}</time>
        <span class="block text-xs text-zinc-500 dark:text-zinc-500">{{ $item->found_on->diffForHumans() }}</span>
    </p>

    <div class="mt-auto flex flex-wrap gap-1.5">
        @if ($showStatus)
            <x-status-badge :item="$item" />
        @endif
        <x-color-badge :color="$item->color" />
        @foreach ($item->tags as $tag)
            <x-badge>{{ $tag->name }}</x-badge>
        @endforeach
    </div>
</x-card>
