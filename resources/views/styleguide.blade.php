<x-layouts.app title="Composants">
    <h1 class="mb-2 text-2xl font-bold tracking-tight">Composants</h1>
    <p class="mb-8 text-sm text-zinc-600 dark:text-zinc-400">Chaque composant du site, dans toutes ses variantes.</p>

    <div class="space-y-8">
        <x-card>
            <h2 class="mb-4 font-semibold">&lt;x-button&gt;</h2>
            <div class="flex flex-wrap gap-2">
                <x-button>Primaire</x-button>
                <x-button variant="secondary">Secondaire</x-button>
                <x-button variant="success">Succès</x-button>
                <x-button variant="danger">Danger</x-button>
                <x-button variant="ghost">Discret</x-button>
                <x-button href="#">Lien en bouton</x-button>
            </div>
        </x-card>

        <x-card>
            <h2 class="mb-4 font-semibold">&lt;x-badge&gt;</h2>
            <div class="space-y-3">
                <div class="flex flex-wrap gap-1.5">
                    <x-badge>étiquette</x-badge>
                    <x-badge classes="bg-indigo-50 text-indigo-800 ring-indigo-200 dark:bg-indigo-950 dark:text-indigo-200 dark:ring-indigo-800">En attente</x-badge>
                    <x-badge classes="bg-emerald-50 text-emerald-800 ring-emerald-200 dark:bg-emerald-950 dark:text-emerald-200 dark:ring-emerald-800">Restitué</x-badge>
                </div>
                <div class="flex flex-wrap gap-1.5">
                    @foreach (App\Enums\PlaceKind::cases() as $kind)
                        <x-place-badge :kind="$kind" />
                    @endforeach
                </div>
                <div class="flex flex-wrap gap-1.5">
                    @foreach (App\Enums\Color::cases() as $color)
                        <x-color-badge :color="$color" />
                    @endforeach
                </div>
            </div>
        </x-card>

        <x-card>
            <h2 class="mb-4 font-semibold">&lt;x-card&gt;</h2>
            <x-card class="bg-zinc-50 dark:bg-zinc-950">Une carte dans une carte.</x-card>
        </x-card>

        <x-card>
            <h2 class="mb-4 font-semibold">Champs de formulaire</h2>
            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <x-label for="demo-input">&lt;x-input&gt;</x-label>
                    <x-input name="demo_input" id="demo-input" placeholder="Texte" />
                </div>
                <div>
                    <x-label for="demo-select">&lt;x-select&gt;</x-label>
                    <x-select name="demo_select" id="demo-select" :options="App\Enums\Color::options()" placeholder="Choisir" />
                </div>
                <div class="sm:col-span-2">
                    <x-label for="demo-textarea">&lt;x-textarea&gt;</x-label>
                    <x-textarea name="demo_textarea" id="demo-textarea" rows="2" placeholder="Texte long" />
                </div>
                <div class="sm:col-span-2">
                    <x-label>Champ refusé</x-label>
                    <input type="text" value="x" class="block w-full rounded-lg border border-red-500 bg-white px-3 py-2 text-sm shadow-sm dark:bg-zinc-900" aria-invalid="true">
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">Le champ nom doit contenir au moins 2 caractères.</p>
                </div>
            </div>
        </x-card>

        <x-card>
            <h2 class="mb-4 font-semibold">Message flash</h2>
            <div role="status" class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 dark:border-emerald-800 dark:bg-emerald-950 dark:text-emerald-200">
                L'objet a été ajouté.
            </div>
        </x-card>
    </div>
</x-layouts.app>
