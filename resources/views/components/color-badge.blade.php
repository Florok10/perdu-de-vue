@props(['color'])

<x-badge :classes="$color->badgeClasses()">
    <span @class(['size-2 rounded-full ring-1 ring-black/20', $color->swatchClasses()]) aria-hidden="true"></span>
    {{ $color->label() }}
</x-badge>
