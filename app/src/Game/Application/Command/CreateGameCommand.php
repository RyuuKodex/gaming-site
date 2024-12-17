<?php

declare(strict_types=1);

namespace App\Game\Application\Command;

final readonly class CreateGameCommand
{
    /**
     * @param ?array<int, string>                                                                   $franchises
     * @param ?array<int, string>                                                                   $gameModes
     * @param ?array<int, string>                                                                   $genres
     * @param ?array<int, mixed>                                                                    $ageRatings
     * @param ?array<int, array{id: int|string, name: string}>                                      $platforms
     * @param ?array<int, array{id: int|string, company: string, developer: bool, publisher: bool}> $involvedCompanies
     */
    public function __construct(
        public string $externalId,
        public string $name,
        public ?float $aggregatedRating,
        public ?int $aggregatedRatingCount,
        public ?int $category,
        public ?string $cover,
        public ?array $franchises,
        public ?array $gameModes,
        public ?array $genres,
        public ?int $releaseDate,
        public ?string $slug,
        public ?int $status,
        public ?string $storyline,
        public ?string $summary,
        public ?string $versionTitle,
        public ?array $ageRatings,
        public ?array $platforms,
        public ?array $involvedCompanies
    ) {}
}
