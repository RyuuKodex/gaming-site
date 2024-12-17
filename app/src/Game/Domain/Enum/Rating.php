<?php

declare(strict_types=1);

namespace App\Game\Domain\Enum;

enum Rating: int
{
    case Three = 1;
    case Seven = 2;
    case Twelve = 3;
    case Sixteen = 4;
    case Eighteen = 5;
    case RP = 6;
    case EC = 7;
    case E = 8;
    case E10 = 9;
    case T = 10;
    case M = 11;
    case AO = 12;
    case CERO_A = 13;
    case CERO_B = 14;
    case CERO_C = 15;
    case CERO_D = 16;
    case CERO_Z = 17;
    case USK_0 = 18;
    case USK_6 = 19;
    case USK_12 = 20;
    case USK_16 = 21;
    case USK_18 = 22;
    case GRAC_ALL = 23;
    case GRAC_Twelve = 24;
    case GRAC_Fifteen = 25;
    case GRAC_Eighteen = 26;
    case GRAC_TESTING = 27;
    case CLASS_IND_L = 28;
    case CLASS_IND_Ten = 29;
    case CLASS_IND_Twelve = 30;
    case CLASS_IND_Fourteen = 31;
    case CLASS_IND_Sixteen = 32;
    case CLASS_IND_Eighteen = 33;
    case ACB_G = 34;
    case ACB_PG = 35;
    case ACB_M = 36;
    case ACB_MA15 = 37;
    case ACB_R18 = 38;
    case ACB_RC = 39;
}
