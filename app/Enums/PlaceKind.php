<?php

namespace App\Enums;

enum PlaceKind: string
{
    case Hall = 'hall';
    case Platform = 'platform';
    case Train = 'train';

    /**
     * Get the label shown to the user.
     */
    public function label(): string
    {
        return match ($this) {
            self::Hall => 'Hall',
            self::Platform => 'Quai',
            self::Train => 'Train',
        };
    }

    /**
     * Get the Tailwind classes of the badge (written in full for Tailwind).
     */
    public function badgeClasses(): string
    {
        return match ($this) {
            self::Hall => 'bg-sky-50 text-sky-800 ring-sky-200 dark:bg-sky-950 dark:text-sky-200 dark:ring-sky-800',
            self::Platform => 'bg-amber-50 text-amber-900 ring-amber-200 dark:bg-amber-950 dark:text-amber-200 dark:ring-amber-800',
            self::Train => 'bg-orange-50 text-orange-800 ring-orange-200 dark:bg-orange-950 dark:text-orange-200 dark:ring-orange-800',
        };
    }
}
