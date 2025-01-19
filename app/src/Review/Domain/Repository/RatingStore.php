<?php

declare(strict_types=1);

namespace App\Review\Domain\Repository;

use App\Review\Domain\Entity\Rating;

interface RatingStore
{
    public function findOneById(string $id): ?Rating;

    public function save(Rating $entity): void;
}
