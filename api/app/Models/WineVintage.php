<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WineVintage extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'wine_id' => 'integer',
            'vintage' => 'integer',
            'price' => 'integer',
            'aging_method' => 'string',
            'alcohol_content' => 'float',
            'technical_comment' => 'string',
        ];
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'wine_id',
        'vintage',
        'price',
        'aging_method',
        'alcohol_content',
        'technical_comment',
    ];

    public function grapeVarieties(): BelongsToMany
    {
        return $this->belongsToMany(GrapeVariety::class, 'wine_varieties');
    }
}
