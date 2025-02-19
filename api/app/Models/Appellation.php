<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appellation extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name' => 'string',
            'appellation_type_id' => 'integer',
            'regulation' => 'string',
        ];
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'appellation_type_id',
        'regulation',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    public function AppellationType(): BelongsTo
    {
        return $this->belongsTo(AppellationType::class);
    }
}
