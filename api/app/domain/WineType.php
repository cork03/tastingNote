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
    public static function create(int $id): self
    {
        return match($id) {
            1 => WineType::Red,
            2 => WineType::White,
            3 => WineType::Orange,
            4 => WineType::Rose,
            5 => WineType::Sparkling,
            default => throw new Exception("該当のワイン種別は存在しません。")
        };
    }
}
