<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producer extends Model
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

    public function wines(): HasMany
    {
        return $this->hasMany(Wine::class);
    }
}
