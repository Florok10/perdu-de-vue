<?php

namespace App\Enums;

enum Color: string
{
    case Black = 'black';
    case White = 'white';
    case Grey = 'grey';
    case Red = 'red';
    case Blue = 'blue';
    case Green = 'green';
    case Yellow = 'yellow';
    case Orange = 'orange';
    case Brown = 'brown';
    case Pink = 'pink';
    case Purple = 'purple';
    case Multicolor = 'multicolor';

    /**
     * Get the label shown to the user.
     */
    public function label(): string
    {
        return match ($this) {
            self::Black => 'Noir',
            self::White => 'Blanc',
            self::Grey => 'Gris',
            self::Red => 'Rouge',
            self::Blue => 'Bleu',
            self::Green => 'Vert',
            self::Yellow => 'Jaune',
            self::Orange => 'Orange',
            self::Brown => 'Brun',
            self::Pink => 'Rose',
            self::Purple => 'Mauve',
            self::Multicolor => 'Multicolore',
        };
    }

    /**
     * Get the Tailwind classes of the badge (written in full for Tailwind).
     */
    public function badgeClasses(): string
    {
        return match ($this) {
            self::Black => 'bg-zinc-800 text-white ring-zinc-900 dark:bg-zinc-950 dark:ring-zinc-600',
            self::White => 'bg-white text-zinc-800 ring-zinc-300 dark:bg-zinc-100 dark:text-zinc-900 dark:ring-zinc-400',
            self::Grey => 'bg-zinc-100 text-zinc-700 ring-zinc-300 dark:bg-zinc-700 dark:text-zinc-100 dark:ring-zinc-500',
            self::Red => 'bg-red-50 text-red-800 ring-red-200 dark:bg-red-950 dark:text-red-200 dark:ring-red-800',
            self::Blue => 'bg-blue-50 text-blue-800 ring-blue-200 dark:bg-blue-950 dark:text-blue-200 dark:ring-blue-800',
            self::Green => 'bg-green-50 text-green-800 ring-green-200 dark:bg-green-950 dark:text-green-200 dark:ring-green-800',
            self::Yellow => 'bg-yellow-50 text-yellow-800 ring-yellow-300 dark:bg-yellow-950 dark:text-yellow-200 dark:ring-yellow-800',
            self::Orange => 'bg-orange-50 text-orange-800 ring-orange-200 dark:bg-orange-950 dark:text-orange-200 dark:ring-orange-800',
            self::Brown => 'bg-amber-100 text-amber-900 ring-amber-300 dark:bg-amber-950 dark:text-amber-200 dark:ring-amber-800',
            self::Pink => 'bg-pink-50 text-pink-800 ring-pink-200 dark:bg-pink-950 dark:text-pink-200 dark:ring-pink-800',
            self::Purple => 'bg-purple-50 text-purple-800 ring-purple-200 dark:bg-purple-950 dark:text-purple-200 dark:ring-purple-800',
            self::Multicolor => 'bg-gradient-to-r from-red-50 via-yellow-50 to-blue-50 text-zinc-800 ring-zinc-300 dark:from-red-950 dark:via-yellow-950 dark:to-blue-950 dark:text-zinc-100 dark:ring-zinc-600',
        };
    }

    /**
     * Get the Tailwind classes of the round colour swatch.
     */
    public function swatchClasses(): string
    {
        return match ($this) {
            self::Black => 'bg-zinc-900',
            self::White => 'bg-white',
            self::Grey => 'bg-zinc-400',
            self::Red => 'bg-red-500',
            self::Blue => 'bg-blue-500',
            self::Green => 'bg-green-500',
            self::Yellow => 'bg-yellow-400',
            self::Orange => 'bg-orange-500',
            self::Brown => 'bg-amber-800',
            self::Pink => 'bg-pink-400',
            self::Purple => 'bg-purple-500',
            self::Multicolor => 'bg-gradient-to-br from-red-500 via-yellow-400 to-blue-500',
        };
    }
}
