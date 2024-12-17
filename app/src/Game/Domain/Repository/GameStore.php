<?php

declare(strict_types=1);

namespace App\Game\Domain\Repository;

use App\Game\Domain\Entity\Game;

interface GameStore
{
    public function save(Game $entity): void;
}
