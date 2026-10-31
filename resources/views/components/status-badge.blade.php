@props(['item'])

@if ($item->isReturned())
    <x-badge classes="bg-emerald-50 text-emerald-800 ring-emerald-200 dark:bg-emerald-950 dark:text-emerald-200 dark:ring-emerald-800">Restitué</x-badge>
@else
    <x-badge classes="bg-indigo-50 text-indigo-800 ring-indigo-200 dark:bg-indigo-950 dark:text-indigo-200 dark:ring-indigo-800">En attente</x-badge>
@endif
