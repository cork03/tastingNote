<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
