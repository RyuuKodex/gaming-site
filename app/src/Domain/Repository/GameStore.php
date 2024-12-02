<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Game;

interface GameStore
{
    public function save(Game $entity): void;
}
