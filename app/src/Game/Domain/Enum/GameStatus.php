<?php

declare(strict_types=1);

namespace App\Game\Domain\Enum;

enum GameStatus: int
{
    case Released = 0;
    case Alpha = 2;
    case Beta = 3;
    case EarlyAccess = 4;
    case Offline = 5;
    case Cancelled = 6;
    case Rumored = 7;
    case Delisted = 8;
}
