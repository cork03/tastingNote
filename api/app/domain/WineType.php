<?php

namespace App\domain;

use Exception;

enum WineType: int
{
    case Red = 1;
    case White = 2;
    case Orange = 3;
    case Rose = 4;
    case Sparkling = 5;

    /**
     * @throws Exception
     */
    public static function fromId(int $id): self
    {
        $enum = self::tryFrom($id);
        if ($enum === null) {
            throw new Exception('Invalid wine type id');
        }
        return $enum;
    }

    public function getLabel(): string
    {
        $labels = [
            self::Red->value => '赤',
            self::White->value => '白',
            self::Orange->value => 'オレンジ',
            self::Rose->value => 'ロゼ',
            self::Sparkling->value => 'スパークリング'
        ];
        return $labels[$this->value];
    }
}
