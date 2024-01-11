<?php

namespace App\Models;

use App\Enums\TypeEnum;
use App\Traits\HasCategory;
use App\Traits\HasComment;
use App\Traits\HasFav;
use App\Traits\HasSchemalessAttributes;
use App\Traits\HasSlug;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;

class Estate extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    use HasSlug, SoftDeletes, HasFav, HasTags, HasUser, HasCategory, HasComment;
    use HasSchemalessAttributes;

    protected $fillable = [
        'user_id',
        'city_id',
        'category_id',
        "title",
        'slug',
        'type',
        'floor',
        'meterage',
        'price',
        'mortgage_price',
        'rent_price',
        'room_count',
        'toilet_count',
        'has_parking',
        'has_elevator',
        'has_warehouse',
    ];

    protected $casts = [
        "type"=> TypeEnum::class,
    ];

    public function registerMediaConversions(Media $media = null): void
    { //TODO
        $this->addMediaConversion('thumbnail')
            ->performOnCollections('gallery')
            ->width(100)
            ->height(100);

        $this->addMediaConversion('480')
            ->width(480)
            ->height(480);

        $this->addMediaConversion('1080')
            ->width(1080)
            ->height(1080);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

}
