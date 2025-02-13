<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WineRanking extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'wine_vintage_id' => 'integer',
            'rank' => 'integer',
            'wine_type_id' => 'integer',
        ];
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'wine_vintage_id',
        'rank',
        'wine_type_id',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    public function wineVintage(): BelongsTo
    {
        return $this->belongsTo(WineVintage::class);
    }

    public function wineType(): BelongsTo
    {
        return $this->belongsTo(WineType::class);
    }
}
