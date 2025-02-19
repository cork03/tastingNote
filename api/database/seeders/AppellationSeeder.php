<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppellationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appellationTypes = [
            ['name' => 'DOCG', 'country_id' => 4],
            ['name' => 'DOC', 'country_id' => 4],
            ['name' => 'IGT', 'country_id' => 4],
            ['name' => 'AOC', 'country_id' => 15],
            ['name' => 'AOP', 'country_id' => 15],
        ];
        foreach ($appellationTypes as $appellationType) {
            DB::table('appellation_types')->insert([
                'name' => $appellationType['name'],
                'country_id' => $appellationType['country_id'],
            ]);
        }
    }
}
