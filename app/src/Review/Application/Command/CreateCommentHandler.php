<?php

declare(strict_types=1);

namespace App\Review\Application\Command;

use App\Review\Domain\Entity\Comment;
use App\Review\Domain\Repository\CommentStore;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
final readonly class CreateCommentHandler
{
    public function __construct(private CommentStore $commentStore) {}

    public function __invoke(CreateCommentCommand $command): void
    {
        $comment = new Comment(Uuid::v4(), $command->user, $command->game, $command->content, new \DateTimeImmutable());

        $this->commentStore->save($comment);
    }
}
