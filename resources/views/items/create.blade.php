<x-layouts.app title="Ajouter un objet">
    <h1 class="mb-6 text-2xl font-bold tracking-tight">Ajouter un objet</h1>

    <x-card>
        <form method="POST" action="{{ route('items.store') }}" class="space-y-6">
            @csrf

            @include('items._form')

            <div class="flex gap-2">
                <x-button type="submit">Enregistrer</x-button>
                <x-button variant="secondary" :href="route('items.index')">Annuler</x-button>
            </div>
        </form>
    </x-card>
</x-layouts.app>
