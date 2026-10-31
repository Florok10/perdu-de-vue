<x-layouts.app :title="$place->name">
    <a href="{{ route('items.index') }}" class="mb-4 inline-block rounded text-sm text-indigo-700 hover:underline focus-visible:outline-2 focus-visible:outline-indigo-600 dark:text-indigo-300">
        ← Retour à la liste
    </a>

    <div class="mb-6 flex flex-wrap items-center gap-3">
        <h1 class="text-2xl font-bold tracking-tight">{{ $place->name }}</h1>
        <x-place-badge :kind="$place->kind" />
    </div>

    <p class="mb-6 text-sm text-zinc-600 dark:text-zinc-400">
        {{ $items->count() }} {{ Str::plural('objet', $items->count()) }} trouvés ici,
        dont {{ $items->filter->isReturned()->count() }} restitués.
    </p>

    @if ($items->isEmpty())
        <x-card class="text-center text-zinc-600 dark:text-zinc-400">Aucun objet trouvé dans ce lieu.</x-card>
    @else
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($items as $item)
                <x-item-card :item="$item" show-status />
            @endforeach
        </div>
    @endif
</x-layouts.app>
