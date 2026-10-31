<x-layouts.app :title="$item->name">
    <a href="{{ route('items.index') }}" class="mb-4 inline-block rounded text-sm text-indigo-700 hover:underline focus-visible:outline-2 focus-visible:outline-indigo-600 dark:text-indigo-300">
        ← Retour à la liste
    </a>

    <x-card class="space-y-6">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">{{ $item->name }}</h1>
                <div class="mt-2 flex flex-wrap gap-1.5">
                    <x-status-badge :item="$item" />
                    <x-color-badge :color="$item->color" />
                    @foreach ($item->tags as $tag)
                        <x-badge>{{ $tag->name }}</x-badge>
                    @endforeach
                </div>
            </div>
            <span @class(['size-10 rounded-full ring-1 ring-black/20', $item->color->swatchClasses()]) aria-hidden="true"></span>
        </div>

        <dl class="grid gap-4 sm:grid-cols-2">
            <div>
                <dt class="text-xs font-semibold uppercase tracking-wide text-zinc-500">Lieu</dt>
                <dd class="mt-1 flex flex-wrap items-center gap-2">
                    <a href="{{ route('places.show', $item->place) }}" class="rounded font-medium text-indigo-700 hover:underline focus-visible:outline-2 focus-visible:outline-indigo-600 dark:text-indigo-300">{{ $item->place->name }}</a>
                    <x-place-badge :kind="$item->place->kind" />
                </dd>
            </div>
            <div>
                <dt class="text-xs font-semibold uppercase tracking-wide text-zinc-500">Trouvé le</dt>
                <dd class="mt-1">
                    {{ $item->found_on->isoFormat('dddd D MMMM YYYY') }}
                    <span class="text-sm text-zinc-500">({{ $item->found_on->diffForHumans() }})</span>
                </dd>
            </div>
            @if ($item->isReturned())
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-zinc-500">Restitué le</dt>
                    <dd class="mt-1">{{ $item->returned_at->isoFormat('dddd D MMMM YYYY') }}</dd>
                </div>
            @endif
            <div class="sm:col-span-2">
                <dt class="text-xs font-semibold uppercase tracking-wide text-zinc-500">Description</dt>
                <dd class="mt-1 whitespace-pre-line text-zinc-700 dark:text-zinc-300">{{ $item->description ?: 'Pas de description.' }}</dd>
            </div>
        </dl>

        <div class="flex flex-wrap gap-2 border-t border-zinc-200 pt-5 dark:border-zinc-800">
            @unless ($item->isReturned())
                <form method="POST" action="{{ route('items.return', $item) }}">
                    @csrf
                    @method('PATCH')
                    <x-button type="submit" variant="success">Marquer comme restitué</x-button>
                </form>
            @endunless

            <x-button variant="secondary" :href="route('items.edit', $item)">Modifier</x-button>

            <form method="POST" action="{{ route('items.destroy', $item) }}" onsubmit="return confirm('Supprimer définitivement cet objet ?')" class="sm:ml-auto">
                @csrf
                @method('DELETE')
                <x-button type="submit" variant="danger">Supprimer</x-button>
            </form>
        </div>
    </x-card>
</x-layouts.app>
