<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WineTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wineTypes = [
            '赤',
            '白',
            'オレンジ',
            'ロゼ',
            'スパークリング'
        ];
        foreach ($wineTypes as $wineType) {
            DB::table('wine_types')->insert([
                'name' => $wineType
            ]);
        }
    }
}
