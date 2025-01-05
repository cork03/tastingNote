<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grapes = [
            'アメリカ',
            'アルゼンチン',
            'イギリス',
            'イタリア',
            'オーストラリア',
            'オーストリア',
            'カナダ',
            'ギリシャ',
            'スペイン',
            'チリ',
            '中国',
            'ドイツ',
            '日本',
            'ニュージーランド',
            'フランス',
            '南アフリカ',
        ];
        foreach ($grapes as $grape) {
            DB::table('countries')->insert([
                'name' => $grape
            ]);
        }

    }
}
