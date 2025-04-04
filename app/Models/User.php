<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasRelationships;
    use InteractsWithMedia;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'tmdb_token',
        'description',
        'public_profile',
        'language',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function profilePicture(int $size = 45): string
    {
        if ($this->getLastMedia('avatar') instanceof Media) {
            return '<img src="'.$this->getLastMedia('avatar')->getUrl().'" width="'.$size.'" height="'.$size.'" class="rounded-full border bg-[#f9f9f9] p-0.5 w-['.$size.'px] h-['.$size.'px]" alt="'.$this->name.'">';
        }

        return '<span class="flex items-center relative w-['.$size.'px] h-['.$size.'px]"><span class="text-xs absolute inset-0 text-center flex items-center justify-center font-medium text-white">&nbsp;</span><img src="https://dummyimage.com/45x45/36c5d3/36c5d3" width="'.$size.'" height="'.$size.'" class="rounded-full border bg-[#f9f9f9] p-0.5 w-['.$size.'px] h-['.$size.'px]" alt="'.$this->name.'"></span>';
    }

    public function profilePictureUrl(): string
    {
        return $this->getLastMedia('avatar') instanceof Media ? $this->getLastMedia('avatar')->getUrl() : 'https://dummyimage.com/45x45/36c5d3/36c5d3';
    }

    public function getLastMedia(string $collectionName = 'default', array $filters = []): ?Media
    {
        $media = cache()->rememberForever('medias_'.$collectionName.$this->id.'_'.$this->getTable(), fn (): \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection => $this->getMedia($collectionName, $filters));

        return $media->last();
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function items(): HasManyDeep
    {
        return $this->hasManyDeep(
            Item::class,
            [Wishlist::class, 'item_wishlist'],
            ['user_id', 'wishlist_id', 'id'],
            ['id', 'id', 'item_id']
        )->distinct();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'public_profile' => 'boolean',
        ];
    }

    #[Scope]
    protected function public(Builder $query): void
    {
        $query->where('public_profile', true);
    }
}
