<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'image',
        'caption',
        'event_id',
        'activity_date',
        'is_featured',
        'order_index',
    ];

    protected function casts(): array
    {
        return [
            'activity_date' => 'date',
            'is_featured' => 'boolean',
            'order_index' => 'integer',
        ];
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : null;
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
