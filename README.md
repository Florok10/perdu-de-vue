# Perdu de vue

**Perdu de vue** ("out of sight") is the lost-and-found website of Wavre railway station (Belgium).
Staff record objects forgotten in the hall, on the platforms and in trains. When the owner shows up,
the object is marked as returned and leaves the list.

It was built as an exam project for the *Framework côté serveur* course, with **Laravel 13**, **Blade**,
**Tailwind CSS 4** and **SQLite**. The interface is in French; code identifiers are in English.

## Features

- **List** (`/objets`): objects still waiting for their owner, newest first, as cards with place,
  date, colour and tags. Filters by place (`?lieu=`) and colour (`?couleur=`), free-text search (`?q=`),
  9 items per page. Filters are kept across pages. An unknown colour is ignored.
- **Item page** (`/objets/{item}`): all details, a link to its place, its tags and its return date.
- **Place page** (`/lieux/{place}`): every object found there, returned ones included, with an
  "En attente" / "Restitué" badge.
- **Add / edit**: one shared Form Request (`ItemRequest`) with French error messages shown under each
  field, values kept after a refused submit (tag checkboxes included), and a flash message.
- **Return**: a `PATCH` form sets `returned_at` to today. An object that is already returned keeps
  its first date.
- **Delete**: a `DELETE` form with a confirmation dialog. Tag links are removed by cascade.
- **Styleguide** (`/composants`): every Blade component in all its variants.
- Extras: pagination, text search, French dates ("2 octobre 2026", "il y a 3 jours"),
  dark mode (toggle remembered in `localStorage`).

## Data model

| Table | Columns |
|---|---|
| `places` | `id`, `name`, `kind` (`PlaceKind` enum: hall, platform, train), timestamps |
| `items` | `id`, `place_id` (FK, cascade), `name` (60), `description` (nullable), `color` (`Color` enum, 12 values), `found_on` (date), `returned_at` (nullable date), timestamps |
| `tags` | `id`, `name`, timestamps |
| `item_tag` | `item_id`, `tag_id` (both FK with cascade, composite primary key) |

A place has many items. An item belongs to a place and has many tags (many-to-many).
See [`docs/diagramme-classes.md`](docs/diagramme-classes.md) for the class diagram.

## Routes

| Verb | URL | Name | Action |
|---|---|---|---|
| ANY | `/` | – | redirect to `/objets` |
| GET | `/objets` | `items.index` | `ItemController@index` |
| GET | `/objets/nouveau` | `items.create` | `ItemController@create` |
| POST | `/objets` | `items.store` | `ItemController@store` |
| GET | `/objets/{item}` | `items.show` | `ItemController@show` |
| GET | `/objets/{item}/modifier` | `items.edit` | `ItemController@edit` |
| PUT | `/objets/{item}` | `items.update` | `ItemController@update` |
| PATCH | `/objets/{item}/restitution` | `items.return` | `ItemController@return` |
| DELETE | `/objets/{item}` | `items.destroy` | `ItemController@destroy` |
| GET | `/lieux/{place}` | `places.show` | `PlaceController@show` |
| GET | `/composants` | `styleguide` | view `styleguide` |

## Project structure

```
app/Enums/            PlaceKind, Color (label(), badgeClasses())
app/Models/           Place, Item, Tag
app/Http/Controllers/ ItemController, PlaceController
app/Http/Requests/    ItemRequest (shared validation)
database/migrations/  places, items, tags, item_tag
database/factories/   PlaceFactory, ItemFactory, TagFactory
database/seeders/     DatabaseSeeder (fixed data: 4 places, 8 tags, 17 items, 4 returned)
resources/views/      layout, components, items/*, places/show, styleguide
lang/fr/              French validation and pagination messages
tests/                Pest tests (one or more per route)
```

## Requirements

- PHP **8.3+** (8.4 recommended) with the `pdo_sqlite`, `mbstring`, `xml`, `curl` and `zip` extensions
- Composer 2
- Node.js **20.19+** or **22.12+** and npm (needed by Vite 8)

The easiest way to get all of them on Windows or macOS is [Laravel Herd](https://herd.laravel.com).
On Linux, use your package manager or [php.new](https://php.new).

## Installation

```bash
git clone https://github.com/<your-account>/perdu-de-vue.git
cd perdu-de-vue
composer install
cp .env.example .env            # Windows PowerShell: copy .env.example .env
php artisan key:generate
php artisan migrate --seed      # creates database/database.sqlite if asked, then fills it
npm install
```

To rebuild the database from scratch at any time (same items, same order every time):

```bash
php artisan migrate:fresh --seed
```

## Running in development

One command starts the PHP server, the queue, the logs and the Vite dev server (hot reload):

```bash
composer run dev
```

Or run the two servers in two terminals:

```bash
php artisan serve
npm run dev
```

Then open <http://localhost:8000>. With Herd, the site is also served at `http://perdu-de-vue.test`
when the folder is in Herd's parked directory (you still need `npm run dev` or `npm run build`).

## Running in production

1. Set the environment in `.env`:

   ```dotenv
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://your-domain.example
   ```

2. Install, build and prepare:

   ```bash
   composer install --no-dev --optimize-autoloader
   php artisan key:generate        # only the first time, if APP_KEY is empty
   php artisan migrate --force     # add --seed the first time for the demo data
   npm ci
   npm run build                   # writes the CSS/JS to public/build
   php artisan optimize            # caches config, routes, events and views
   ```

3. Point the web server's document root to the **`public/`** folder (Apache uses `public/.htaccess`;
   for Nginx, see the [Laravel deployment guide](https://laravel.com/docs/deployment)).
   The web server user must be able to write to `storage/`, `bootstrap/cache/` and `database/`
   (the SQLite file and its folder).

After each update: `git pull`, then repeat step 2 (`php artisan optimize:clear` first if the cache
gets in the way).

## Tests and code style

```bash
php artisan test          # Pest
vendor/bin/pint --test    # code style check (lang/ is excluded in pint.json)
vendor/bin/pint           # fix the style
php artisan route:list --except-vendor   # should show 11 routes
```

## Licence

MIT.
