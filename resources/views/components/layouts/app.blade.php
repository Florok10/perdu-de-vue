@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ? $title.' · ' : '' }}{{ config('app.name') }}</title>
    <script>
        try {
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        } catch (e) {}
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-zinc-50 font-sans text-zinc-900 antialiased dark:bg-zinc-950 dark:text-zinc-100">
    <a href="#contenu" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:rounded-lg focus:bg-white focus:px-3 focus:py-2 focus:text-indigo-700">
        Aller au contenu
    </a>

    <header class="border-b border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-3 px-4 py-3">
            <a href="{{ route('items.index') }}" class="flex items-center gap-2 rounded-lg focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                <span class="grid size-9 place-items-center rounded-xl bg-indigo-600 text-lg text-white" aria-hidden="true">?</span>
                <span>
                    <span class="block font-semibold leading-tight">Perdu de vue</span>
                    <span class="block text-xs text-zinc-500 dark:text-zinc-400">Objets trouvés · Gare de Wavre</span>
                </span>
            </a>

            <nav class="flex flex-wrap items-center gap-1" aria-label="Navigation principale">
                <x-nav-link :href="route('items.index')" :active="request()->routeIs('items.index', 'items.show', 'items.edit', 'places.show')">Objets</x-nav-link>
                <x-nav-link :href="route('items.create')" :active="request()->routeIs('items.create')">Ajouter</x-nav-link>
                <x-nav-link :href="route('styleguide')" :active="request()->routeIs('styleguide')">Composants</x-nav-link>
                <button type="button" data-theme-toggle
                        class="ml-1 rounded-lg px-3 py-2 text-sm text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white"
                        aria-label="Basculer le mode sombre">
                    <span class="dark:hidden">Mode sombre</span>
                    <span class="hidden dark:inline">Mode clair</span>
                </button>
            </nav>
        </div>
    </header>

    <main id="contenu" class="mx-auto max-w-6xl px-4 py-8">
        <x-flash />

        {{ $slot }}
    </main>

    <footer class="mx-auto max-w-6xl px-4 pb-8 text-center text-xs text-zinc-500 dark:text-zinc-400">
        Bureau des objets trouvés de la gare de Wavre, à côté des guichets.
    </footer>
</body>
</html>
