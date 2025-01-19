<?php

declare(strict_types=1);

namespace App\Review\Domain\Repository;

use App\Review\Domain\Entity\Comment;

interface CommentStore
{
    public function findOneById(string $id): ?Comment;

    public function save(Comment $entity): void;
}
