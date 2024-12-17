<?php

declare(strict_types=1);

namespace App\Game\Domain\Repository;

use App\Game\Domain\Entity\AgeRating;

interface AgeRatingStore
{
    public function findOneByRating(int $rating): ?AgeRating;
}
