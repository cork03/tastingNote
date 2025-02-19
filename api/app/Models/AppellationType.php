<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AppellationType extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name' => 'string',
            'country_id' => 'integer',
        ];
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'country_id'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    public function Appellation(): HasOne
    {
        return $this->hasOne(Appellation::class);
    }

    public function Country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
