<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WineComment extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'wine_vintage_id' => 'integer',
            'appearance' => 'string',
            'aroma' => 'string',
            'taste' => 'string',
            'another_comment' => 'string',
        ];
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'wine_vintage_id',
        'appearance',
        'aroma',
        'taste',
        'another_comment',
    ];

    public function wineVintage(): BelongsTo
    {
        return $this->belongsTo(WineVintage::class);
    }

    public function blindTastingAnswer(): HasOne
    {
        return $this->hasOne(BlindTastingAnswer::class);
    }
}
