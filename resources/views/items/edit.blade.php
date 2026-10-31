<x-layouts.app :title="'Modifier '.$item->name">
    <h1 class="mb-6 text-2xl font-bold tracking-tight">Modifier « {{ $item->name }} »</h1>

    <x-card>
        <form method="POST" action="{{ route('items.update', $item) }}" class="space-y-6">
            @csrf
            @method('PUT')

            @include('items._form')

            <div class="flex gap-2">
                <x-button type="submit">Enregistrer les modifications</x-button>
                <x-button variant="secondary" :href="route('items.show', $item)">Annuler</x-button>
            </div>
        </form>
    </x-card>
</x-layouts.app>
