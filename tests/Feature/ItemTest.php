<?php

use App\Enums\Color;
use App\Models\Item;
use App\Models\Place;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

test('the home page redirects to the list', function () {
    $this->get('/')->assertRedirect('/objets');
});

test('the list shows waiting items only', function () {
    $waiting = Item::factory()->create(['name' => 'Parapluie à pois']);
    $returned = Item::factory()->returned()->create(['name' => 'Gant perdu']);

    $this->get(route('items.index'))
        ->assertOk()
        ->assertSee($waiting->name)
        ->assertDontSee($returned->name);
});

test('the list can be filtered by place and colour', function () {
    $place = Place::factory()->create();
    Item::factory()->for($place)->create(['name' => 'Écharpe rouge', 'color' => Color::Red]);
    Item::factory()->for($place)->create(['name' => 'Bonnet bleu', 'color' => Color::Blue]);
    Item::factory()->create(['name' => 'Gant rouge', 'color' => Color::Red]);

    $this->get(route('items.index', ['lieu' => $place->id, 'couleur' => 'red']))
        ->assertSee('Écharpe rouge')
        ->assertDontSee('Bonnet bleu')
        ->assertDontSee('Gant rouge');
});

test('an unknown colour is ignored', function () {
    Item::factory()->create(['name' => 'Valise grise', 'color' => Color::Grey]);

    $this->get(route('items.index', ['couleur' => 'violet']))->assertOk()->assertSee('Valise grise');
});

test('the item page shows the item and its place', function () {
    $item = Item::factory()->create();

    $this->get(route('items.show', $item))->assertOk()->assertSee($item->name)->assertSee($item->place->name);
});

test('an unknown item answers 404', function () {
    $this->get('/objets/999')->assertNotFound();
});

test('the place page shows returned items too', function () {
    $place = Place::factory()->create();
    Item::factory()->for($place)->returned()->create(['name' => 'Gant perdu']);

    $this->get(route('places.show', $place))->assertOk()->assertSee('Gant perdu')->assertSee('Restitué');
});

test('the create and edit forms are shown', function () {
    $item = Item::factory()->create();

    $this->get(route('items.create'))->assertOk();
    $this->get(route('items.edit', $item))->assertOk()->assertSee($item->name);
});

test('an item can be added with its tags', function () {
    $place = Place::factory()->create();
    $tag = Tag::factory()->create();

    $this->post(route('items.store'), [
        'name' => 'Trompette',
        'color' => 'yellow',
        'found_on' => today()->toDateString(),
        'place_id' => $place->id,
        'tags' => [$tag->id],
    ])->assertRedirect()->assertSessionHas('status');

    $item = Item::firstWhere('name', 'Trompette');
    $this->assertDatabaseHas('item_tag', ['item_id' => $item->id, 'tag_id' => $tag->id]);
});

test('an empty form shows four errors', function () {
    $this->post(route('items.store'), [])
        ->assertSessionHasErrors(['name', 'color', 'found_on', 'place_id']);
});

test('a future date is refused', function () {
    $this->post(route('items.store'), ['found_on' => today()->addDay()->toDateString()])
        ->assertSessionHasErrors(['found_on' => 'La date de découverte ne peut pas être dans le futur.']);
});

test('an item can be updated and its tags synced', function () {
    $item = Item::factory()->hasAttached(Tag::factory())->create();

    $this->put(route('items.update', $item), [
        'name' => 'Nouveau nom',
        'color' => 'green',
        'found_on' => $item->found_on->toDateString(),
        'place_id' => $item->place_id,
    ])->assertRedirect(route('items.show', $item));

    $this->assertDatabaseHas('items', ['id' => $item->id, 'name' => 'Nouveau nom', 'color' => 'green']);
    expect($item->tags()->count())->toBe(0);
});

test('an item can be returned only once', function () {
    $item = Item::factory()->create();

    $this->patch(route('items.return', $item))->assertRedirect(route('items.index'));
    expect($item->fresh()->returned_at->isToday())->toBeTrue();

    $item->update(['returned_at' => '2026-10-01']);
    $this->patch(route('items.return', $item))->assertRedirect(route('items.show', $item));
    expect($item->fresh()->returned_at->toDateString())->toBe('2026-10-01');
});

test('deleting an item removes its tag links', function () {
    $item = Item::factory()->hasAttached(Tag::factory()->count(2))->create();

    $this->delete(route('items.destroy', $item))->assertRedirect(route('items.index'));

    $this->assertModelMissing($item);
    expect(DB::table('item_tag')->where('item_id', $item->id)->count())->toBe(0);
});

test('the styleguide page is shown', function () {
    $this->get(route('styleguide'))->assertOk();
});
