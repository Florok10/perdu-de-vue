<?php

namespace App\Models;

use App\Enums\Color;
use Database\Factories\ItemFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['place_id', 'name', 'description', 'color', 'found_on', 'returned_at'])]
class Item extends Model
{
    /** @use HasFactory<ItemFactory> */
    use HasFactory;

    /**
     * Get the place where the item was found.
     *
     * @return BelongsTo<Place, $this>
     */
    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    /**
     * Get the tags of the item.
     *
     * @return BelongsToMany<Tag, $this>
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Tell whether the item has been returned to its owner.
     */
    public function isReturned(): bool
    {
        return $this->returned_at !== null;
    }

    /**
     * Keep only the items still waiting for their owner.
     *
     * @param  Builder<Item>  $query
     */
    #[Scope]
    protected function waiting(Builder $query): void
    {
        $query->whereNull('returned_at');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'color' => Color::class,
            'found_on' => 'date',
            'returned_at' => 'date',
        ];
    }
}
