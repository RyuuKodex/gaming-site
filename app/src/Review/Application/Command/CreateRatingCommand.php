<?php

declare(strict_types=1);

namespace App\Review\Application\Command;

use App\Game\Domain\Entity\Game;
use App\User\Domain\Entity\User;

class CreateRatingCommand
{
    public function __construct(
        public User $user,
        public Game $game,
        public int $rating,
    ) {}
}
