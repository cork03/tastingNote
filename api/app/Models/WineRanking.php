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
        ];
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'wine_vintage_id',
        'rank',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    public function wineVintage(): BelongsTo
    {
        return $this->belongsTo(WineVintage::class);
    }
}
