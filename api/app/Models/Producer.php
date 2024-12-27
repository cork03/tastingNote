<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
