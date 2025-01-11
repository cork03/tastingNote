<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WineType extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name' => 'string',
        ];
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;
}
