<?php

namespace Database\Seeders;

use App\Enums\Color;
use App\Enums\PlaceKind;
use App\Models\Place;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database with fixed data (no fake()).
     */
    public function run(): void
    {
        $places = collect([
            'hall' => ['Hall des guichets', PlaceKind::Hall],
            'quai1' => ['Quai 1', PlaceKind::Platform],
            'quai3' => ['Quai 3', PlaceKind::Platform],
            'train' => ['IC 2309 Bruxelles-Midi – Namur', PlaceKind::Train],
        ])->map(fn (array $place) => Place::create(['name' => $place[0], 'kind' => $place[1]]));

        $tags = collect([
            'fragile', 'vivant', 'électronique', 'vêtement',
            'document', 'enfant', 'encombrant', 'odorant',
        ])->mapWithKeys(fn (string $name) => [$name => Tag::create(['name' => $name])]);

        $items = [
            ['hall', 'Accordéon dans son étui', 'Accordéon chromatique rouge, étui en cuir usé avec un autocollant « Bal musette de Jodoigne ».', Color::Red, '2026-10-02', null, ['fragile', 'encombrant']],
            ['quai1', 'Valise de cartes Pokémon', 'Petite valise en métal remplie de classeurs. Un Dracaufeu holographique est glissé sous le couvercle.', Color::Yellow, '2026-10-04', '2026-10-06', ['enfant']],
            ['train', 'Tortue « Bernadette »', 'Tortue de Hermann dans une boîte à chaussures percée de trous, avec trois feuilles de salade.', Color::Green, '2026-10-05', '2026-10-07', ['vivant', 'fragile']],
            ['quai3', 'Parapluie-canne en bois', 'Grand parapluie noir, poignée en bois sculptée en tête de canard.', Color::Black, '2026-10-07', null, []],
            ['hall', 'Gâteau d\'anniversaire « 80 ans Mamy »', 'Gâteau aux fraises dans une boîte de pâtisserie de Wavre, bougies 8 et 0 encore emballées.', Color::Pink, '2026-10-09', null, ['fragile', 'odorant']],
            ['train', 'Ordinateur portable avec stickers', 'Portable gris couvert d\'autocollants de festivals (Dour 2024, Esperanzah). Chargeur absent.', Color::Grey, '2026-10-10', null, ['électronique']],
            ['quai1', 'Doudou lapin à une oreille', 'Lapin en peluche beige, il lui manque l\'oreille gauche. Prénom brodé : « Pompon ».', Color::Brown, '2026-10-12', '2026-10-13', ['enfant']],
            ['hall', 'Classeur de mémoire de fin d\'études', 'Classeur bleu « Mémoire — Gestion des eaux pluviales à Wavre », annoté au crayon rouge.', Color::Blue, '2026-10-14', null, ['document']],
            ['quai3', 'Planche de surf', 'Planche en mousse de 2,10 m, à motif de flammes. Surprenant si loin de la mer.', Color::Multicolor, '2026-10-15', null, ['encombrant']],
            ['train', 'Écharpe tricotée de 3 mètres', 'Écharpe en laine faite main, rayures mauves et blanches, un pompon à chaque bout.', Color::Purple, '2026-10-17', null, ['vêtement']],
            ['hall', 'Cage avec perruche', 'Perruche ondulée qui répète « Attention au départ ». Cage dorée avec une balançoire.', Color::Blue, '2026-10-19', null, ['vivant', 'encombrant']],
            ['quai1', 'Sac de fromages de Herve', 'Sac isotherme contenant quatre fromages de Herve bien affinés. Signalé par tout le quai.', Color::Orange, '2026-10-21', null, ['odorant']],
            ['train', 'Casque audio sans fil', 'Casque blanc à réduction de bruit, gravé « Noé » sur l\'arceau.', Color::White, '2026-10-23', null, ['électronique', 'fragile']],
            ['quai3', 'Veste de costume de mariage', 'Veste bordeaux avec une boutonnière fleurie et un plan de table dans la poche intérieure.', Color::Red, '2026-10-25', null, ['vêtement', 'document']],
            ['hall', 'Trottinette pliante', 'Trottinette d\'enfant verte, guidon décoré de rubans. Une roue grince.', Color::Green, '2026-10-27', null, ['enfant', 'encombrant']],
            ['train', 'Mallette de magicien', 'Mallette noire avec un chapeau haut-de-forme, trois foulards et un lapin en plastique.', Color::Black, '2026-10-29', '2026-10-30', ['fragile']],
            ['quai1', 'Bonnet de lutin', 'Bonnet vert et rouge à grelot, taille adulte. Il est un peu tôt pour Noël.', Color::Multicolor, '2026-10-31', null, ['vêtement']],
        ];

        foreach ($items as [$place, $name, $description, $color, $foundOn, $returnedAt, $tagNames]) {
            $item = $places[$place]->items()->create([
                'name' => $name,
                'description' => $description,
                'color' => $color,
                'found_on' => $foundOn,
                'returned_at' => $returnedAt,
            ]);

            $item->tags()->attach($tags->only($tagNames)->pluck('id'));
        }
    }
}
