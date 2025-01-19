<?php

declare(strict_types=1);

namespace App\Review\Application\Command;

use App\Review\Domain\Entity\Rating;
use App\Review\Domain\Repository\RatingStore;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
final readonly class CreateRatingHandler
{
    public function __construct(private RatingStore $ratingStore) {}

    public function __invoke(CreateRatingCommand $command): void
    {
        $rating = new Rating(Uuid::v4(), $command->user, $command->game, $command->rating, new \DateTimeImmutable());

        $this->ratingStore->save($rating);
    }
}
