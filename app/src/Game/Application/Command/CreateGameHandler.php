<?php

declare(strict_types=1);

namespace App\Game\Application\Command;

use App\Game\Domain\Entity\AgeRating;
use App\Game\Domain\Entity\Game;
use App\Game\Domain\Entity\GameAgeRating;
use App\Game\Domain\Entity\GamePlatform;
use App\Game\Domain\Entity\InvolvedCompany;
use App\Game\Domain\Entity\Platform;
use App\Game\Domain\Enum\AgeRatingCategory;
use App\Game\Domain\Enum\GameCategory;
use App\Game\Domain\Enum\GameStatus;
use App\Game\Domain\Enum\Rating;
use App\Game\Domain\Repository\AgeRatingStore;
use App\Game\Domain\Repository\GameStore;
use App\Game\Domain\Repository\PlatformStore;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
final readonly class CreateGameHandler
{
    public function __construct(
        private GameStore $gameStore,
        private PlatformStore $platformStore,
        private AgeRatingStore $ageRatingStore
    ) {}

    public function __invoke(CreateGameCommand $command): void
    {
        $gameAgeRatings = [];
        $gamePlatforms = [];
        $companyEntities = [];

        $gameModes = $command->gameModes ?? [];
        $genres = $command->genres ?? [];
        $franchiseNames = $command->franchises ?? [];

        $gameDb = new Game(
            Uuid::v4(),
            $command->externalId,
            $command->name,
            null,
            $command->aggregatedRating,
            $command->aggregatedRatingCount,
            isset($command->category) ? GameCategory::from($command->category) : null,
            $command->cover,
            $franchiseNames,
            $gameModes,
            $genres,
            null,
            null,
            isset($command->releaseDate) ? (new \DateTimeImmutable())->setTimestamp($command->releaseDate) : null,
            $command->slug,
            isset($command->status) ? GameStatus::from($command->status) : null,
            $command->storyline,
            $command->summary,
            $command->versionTitle
        );

        foreach ($command->ageRatings ?? [] as $rating) {
            $existingAgeRating = $this->ageRatingStore->findOneByRating($rating['rating']);
            $ageRating = $existingAgeRating ?? new AgeRating(
                Uuid::v4(),
                (string) $rating['id'],
                Rating::from($rating['rating']),
                AgeRatingCategory::from($rating['category'])
            );

            $gameAgeRatings[] = new GameAgeRating(Uuid::v4(), $ageRating, $gameDb);
        }

        foreach ($command->platforms ?? [] as $platform) {
            $existingPlatform = $this->platformStore->findOneByExternalId((string) $platform['id']);
            $platformEntity = $existingPlatform ?? new Platform(Uuid::v4(), (string) $platform['id'], $platform['name']);
            $gamePlatforms[] = new GamePlatform(Uuid::v4(), $platformEntity, $gameDb);
        }

        foreach ($command->involvedCompanies ?? [] as $company) {
            $companyEntities[] = new InvolvedCompany(
                Uuid::v4(),
                (string) $company['id'],
                (string) $company['company'],
                $company['developer'],
                $company['publisher']
            );
        }

        if (!empty($gameAgeRatings)) {
            $gameDb->setGameAgeRatings(new ArrayCollection($gameAgeRatings));
        }

        if (!empty($gamePlatforms)) {
            $gameDb->setGamePlatforms(new ArrayCollection($gamePlatforms));
        }

        if (!empty($companyEntities)) {
            $gameDb->setInvolvedCompanies(new ArrayCollection($companyEntities));
        }

        $this->gameStore->save($gameDb);
    }
}
