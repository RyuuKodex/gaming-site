<?php

declare(strict_types=1);

namespace App\Game\Domain\Enum;

enum AgeRatingCategory: int
{
    case ESRB = 1;
    case PEGI = 2;
    case CERO = 3;
    case USK = 4;
    case GRAC = 5;
    case CLASS_IND = 6;
    case ACB = 7;
}
