<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wine extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name' => 'string',
            'producer_id' => 'integer',
            'wine_type_id' => 'integer'
        ];
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'producer_id',
        'wine_type_id'
    ];
    public $timestamps = false;
}
