<?php

declare(strict_types=1);

namespace App\Game\Domain\Enum;

enum Region: int
{
    case Europe = 1;
    case NorthAmerica = 2;
    case Australia = 3;
    case NewZealand = 4;
    case Japan = 5;
    case China = 6;
    case Asia = 7;
    case Worldwide = 8;
    case Korea = 9;
    case Brazil = 10;
}
