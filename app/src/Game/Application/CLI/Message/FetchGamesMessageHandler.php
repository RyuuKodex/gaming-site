<?php

declare(strict_types=1);

namespace App\Game\Application\CLI\Message;

use App\Game\Application\Command\CreateGameCommand;
use App\Game\Application\Command\CreateGameHandler;
use App\Game\Infrastructure\HttpClient\IGDBClient;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class FetchGamesMessageHandler
{
    public function __construct(private IGDBClient $client, private CreateGameHandler $handler) {}

    public function __invoke(FetchGamesMessage $message): void
    {
        $games = $this->client->getGames($message->limit, $message->offset, $message->accessToken);

        foreach ($games as $game) {
            $command = new CreateGameCommand(
                externalId: (string) $game['id'],
                name: $game['name'],
                aggregatedRating: $game['aggregated_rating'] ?? null,
                aggregatedRatingCount: $game['aggregated_rating_count'] ?? null,
                category: $game['category'] ?? null,
                cover: $game['cover']['url'] ?? null,
                franchises: isset($game['franchises']) ? array_column($game['franchises'], 'name') : [],
                gameModes: isset($game['game_modes']) ? array_column($game['game_modes'], 'name') : [],
                genres: isset($game['genres']) ? array_column($game['genres'], 'name') : [],
                releaseDate: $game['first_release_date'] ?? null,
                slug: $game['slug'] ?? null,
                status: $game['game_status'] ?? null,
                storyline: $game['storyline'] ?? null,
                summary: $game['summary'] ?? null,
                versionTitle: $game['version_title'] ?? null,
                ageRatings: $game['age_ratings'] ?? [],
                platforms: $game['platforms'] ?? [],
                involvedCompanies: $game['involved_companies'] ?? []
            );

            ($this->handler)($command);
        }
    }
}
