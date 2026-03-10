<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'poster',
        'event_date',
        'event_time',
        'location',
        'category',
        'tags',
        'is_featured',
        'is_active',
        'has_popup',
        'show_in_navbar',
        'popup_image_url',
        'popup_redirect_url',
    ];

    protected function casts(): array
    {
        return [
            'content' => 'string',
            'tags' => 'array',
            'event_date' => 'date',
            'event_time' => 'datetime:H:i',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'has_popup' => 'boolean',
            'show_in_navbar' => 'boolean',
        ];
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->poster
            ? asset('storage/' . $this->poster)
            : null;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now()->toDateString());
    }

    public function scopeWithPopup($query)
    {
        return $query->where('has_popup', true)
            ->where('is_active', true)
            ->where('event_date', '>=', now()->toDateString())
            ->orderBy('event_date')
            ->first();
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }
}
