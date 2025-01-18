<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class GrapeVariety extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    public function wineVintages(): BelongsToMany
    {
        return $this
            ->belongsToMany(WineVintage::class, 'wine_varieties')
            ->withPivot('percentage');
    }
}
