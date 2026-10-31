@props(['kind'])

<x-badge :classes="$kind->badgeClasses()">{{ $kind->label() }}</x-badge>
