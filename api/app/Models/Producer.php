<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producer extends Model
{
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name' => 'string',
            'country_id' => 'integer',
            'description' => 'string',
            'url' => 'string',
        ];
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'country_id',
        'description',
        'url',
    ];
    /**
     * @var bool
     */
    public $timestamps = false;

    public function wines(): HasMany
    {
        return $this->hasMany(Wine::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
