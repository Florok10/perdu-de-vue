<x-layouts.app title="Objets trouvés">
    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Objets en attente</h1>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                {{ $items->total() }} {{ Str::plural('objet', $items->total()) }} attendent leur propriétaire.
            </p>
        </div>
        <x-button :href="route('items.create')">Ajouter un objet</x-button>
    </div>

    <x-card class="mb-6">
        <form method="GET" action="{{ route('items.index') }}" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-[2fr_1fr_1fr_auto] lg:items-end">
            <div>
                <x-label for="q">Recherche</x-label>
                <x-input name="q" type="search" :value="$search" placeholder="Parapluie, doudou…" />
            </div>
            <div>
                <x-label for="lieu">Lieu</x-label>
                <x-select name="lieu" :options="$places->pluck('name', 'id')" :value="$selectedPlace?->id" placeholder="Tous les lieux" />
            </div>
            <div>
                <x-label for="couleur">Couleur</x-label>
                <x-select name="couleur" :options="App\Enums\Color::options()" :value="$selectedColor?->value" placeholder="Toutes les couleurs" />
            </div>
            <div class="flex gap-2 sm:col-span-2 lg:col-span-1">
                <x-button type="submit" class="flex-1 lg:flex-none">Filtrer</x-button>
                @if ($selectedPlace || $selectedColor || $search !== '')
                    <x-button variant="secondary" :href="route('items.index')">Effacer</x-button>
                @endif
            </div>
        </form>
    </x-card>

    @if ($items->isEmpty())
        <x-card class="text-center text-zinc-600 dark:text-zinc-400">
            Aucun objet ne correspond à ces critères.
        </x-card>
    @else
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($items as $item)
                <x-item-card :item="$item" />
            @endforeach
        </div>

        <div class="mt-8">
            {{ $items->links() }}
        </div>
    @endif
</x-layouts.app>
