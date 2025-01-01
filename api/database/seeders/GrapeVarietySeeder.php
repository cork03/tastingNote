<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrapeVarietySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grapes = [
            'アシルティコ',
            'アリアニコ',
            'カベルネ・ソーヴィニヨン',
            'カベルネ・フラン',
            'カリニャン',
            'カンノナウ',
            'クシノマヴロ',
            'グルナッシュ(ガルナッチャ)',
            'コルヴィーナ',
            'サグランティーノ',
            'サンジョベーゼ',
            'サンソー',
            'シラー(ズ)',
            '小公子',
            'タナ',
            'ツヴァイゲルト',
            'テンプラニーリョ',
            'ネッビオーロ',
            'ネレッロ・マスカレーぜ',
            'ネロ・ダーヴォラ',
            'バルベーラ',
            'ビノタージュ',
            'ピノ・ノワール',
            'プチベルドー',
            'ブラウフレンキッシュ',
            'プリミティーヴォ(ジンファンデル)',
            'マスカットベーリーA',
            'マルベック',
            'メルロー',
            'メンシア',
            'モンテプルチアーノ',
            'モンドゥーズ',
            '山幸',
            'アリゴテ',
            'アルネイス',
            'アルヴァリーニョ',
            'ヴィオニエ',
            'オンダラビ・スリ',
            'ガルガーネガ',
            'ゲヴュルツトラミネール',
            '甲州',
            'シャスラ',
            'シャルドネ',
            'シュナンブラン',
            'ジルヴァーナ',
            'セミヨン',
            'ソーヴィニヨン・ブラン',
            'チャレッロ',
            'トロンテス',
            'ピクプール・ブラン',
            'ピノ・グリ',
            'フィアーノ',
            'ミュスカデ',
            'リースリング',
            'マルサンヌ'
        ];
        foreach ($grapes as $grape) {
            DB::table('grape_varieties')->insert([
                'name' => $grape
            ]);
        }

    }
}
