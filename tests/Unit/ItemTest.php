<?php

use App\Enums\Color;
use App\Enums\PlaceKind;
use App\Models\Item;

test('an item is returned when it has a return date', function () {
    expect((new Item)->isReturned())->toBeFalse()
        ->and((new Item(['returned_at' => '2026-10-10']))->isReturned())->toBeTrue();
});

test('every enum case has a label', function () {
    expect(PlaceKind::Platform->label())->toBe('Quai')
        ->and(Color::Purple->label())->toBe('Mauve')
        ->and(Color::options())->toHaveCount(12);
});
