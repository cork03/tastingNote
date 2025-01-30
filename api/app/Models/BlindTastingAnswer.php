<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BlindTastingAnswer extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'wine_comment_id' => 'integer',
            'country_id' => 'integer',
            'vintage' => 'integer',
            'price' => 'integer',
            'alcohol_content' => 'float',
            'another_comment' => 'string',
        ];
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'wine_comment_id',
        'country_id',
        'vintage',
        'price',
        'alcohol_content',
        'another_comment',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    public function grapeVarieties(): BelongsToMany
    {
        return $this
            ->belongsToMany(GrapeVariety::class, 'blind_tasting_wine_varieties')
            ->withPivot('percentage');
    }

    public function wineComment(): BelongsTo
    {
        return $this->belongsTo(WineComment::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
