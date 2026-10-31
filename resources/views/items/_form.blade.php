{{-- Fields shared by the add and edit forms. No HTML "required": the server validates. --}}
<div class="grid gap-5 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <x-label for="name">Nom</x-label>
        <x-input name="name" :value="$item->name" placeholder="Ex. Parapluie à pois" />
    </div>

    <div>
        <x-label for="place_id">Lieu</x-label>
        <x-select name="place_id" :options="$places->pluck('name', 'id')" :value="$item->place_id" placeholder="Choisir un lieu" />
    </div>

    <div>
        <x-label for="color">Couleur</x-label>
        <x-select name="color" :options="App\Enums\Color::options()" :value="$item->color?->value" placeholder="Choisir une couleur" />
    </div>

    <div>
        <x-label for="found_on">Date de découverte</x-label>
        <x-input name="found_on" type="date" :value="$item->found_on?->format('Y-m-d')" />
    </div>

    <div class="sm:col-span-2">
        <x-label for="description">Description <span class="font-normal text-zinc-500">(facultative)</span></x-label>
        <x-textarea name="description" :value="$item->description" placeholder="Ce qui aidera le propriétaire à le reconnaître…" />
    </div>

    <div class="sm:col-span-2">
        <x-tag-checkboxes :tags="$tags" :selected="$item->tags->pluck('id')->all()" />
    </div>
</div>
