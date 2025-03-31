<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Override;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'synopsis',
        'release_date',
        'watched',
        'media_type',
        'backdrop_path',
        'poster_path',
        'note',
    ];

    public function wishlist(): BelongsToMany
    {
        return $this->belongsToMany(Wishlist::class);
    }

    #[Override]
    protected static function boot()
    {
        parent::boot();

        static::deleting(function (self $item): void {
            $item->wishlist()->detach();
        });
    }
}
