<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Wine extends Model
{
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name' => 'string',
            'producer_id' => 'integer',
            'wine_type_id' => 'integer',
            'country_id' => 'integer',
            'appellation_id' => 'integer'
        ];
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'producer_id',
        'wine_type_id',
        'country_id',
        'appellation_id'
    ];


    public $timestamps = false;

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function producer(): BelongsTo
    {
        return $this->belongsTo(Producer::class);
    }

    public function wineVintages(): HasMany
    {
        return $this->hasMany(WineVintage::class);
    }

    public function appellation(): BelongsTo
    {
        return $this->belongsTo(Appellation::class);
    }

    public function wineType(): BelongsTo
    {
        return $this->belongsTo(WineType::class);
    }
}
