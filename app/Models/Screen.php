<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'location',
    'is_blocked',
    'blocked_message',
    'manual_slides_position',
    'refresh_seconds',
])]
class Screen extends Model
{
    /**
     * @return HasMany<ManualSlide, $this>
     */
    public function manualSlides(): HasMany
    {
        return $this->hasMany(ManualSlide::class)->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_blocked' => 'boolean',
            'refresh_seconds' => 'integer',
        ];
    }
}
