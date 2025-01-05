<?php

namespace Database\Seeders;

use App\Models\Producer;
use App\Models\Wine;
use Illuminate\Database\Seeder;

class TestWineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producer::factory()
            ->count(3)
            ->sequence(
                ['name' => 'ドメーヌ・ド・ラ・ロマネ・コンティ(DRC)'],
                ['name' => 'シャトー・ブラーヌ・カントナック'],
                ['name' => 'クレランス・デュロン']
            )->has(
                Wine::factory()
                    ->count(3)
                    ->sequence(
                        ['name' => 'Grand Vin'],
                        ['name' => 'Second Wine'],
                        ['name' => 'Third Wine']
                    )
            )
            ->create();
    }
}
