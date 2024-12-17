<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\HttpClient;

use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class IGDBClient
{
    public function __construct(private HttpClientInterface $httpClient, private string $clientId) {}

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getGames(int $limit, int $offset, string $accessToken): array
    {
        $headers = [
            'Client-ID' => $this->clientId,
            'Authorization' => 'Bearer '.$accessToken,
            'Accept' => 'application/json',
        ];

        $response = $this->httpClient->request(
            'POST',
            'https://api.igdb.com/v4/games',
            [
                'headers' => $headers,
                'body' => <<<EOT
                    fields
                        age_ratings.*,
                        aggregated_rating,
                        aggregated_rating_count,
                        alternative_names.*,
                        artworks.*,
                        bundles.*,
                        category,
                        collections.*,
                        cover.*,
                        created_at,
                        dlcs.*,
                        expanded_games.*,
                        expansions.*,
                        first_release_date,
                        forks.*,
                        franchise,
                        franchises.*,
                        game_engines.*,
                        game_localizations.*,
                        game_modes.*,
                        genres.*,
                        involved_companies.*,
                        keywords.*,
                        language_supports.*,
                        multiplayer_modes.*,
                        name,
                        parent_game,
                        platforms.*,
                        player_perspectives.*,
                        ports.*,
                        release_dates.*,
                        remakes.*,
                        remasters.*,
                        screenshots.*,
                        similar_games.*,
                        slug,
                        standalone_expansions.*,
                        status,
                        storyline,
                        summary,
                        themes.*,
                        url,
                        version_parent,
                        version_title,
                        videos.*,
                        websites.*;
                    limit {$limit};
                    offset {$offset};
                    EOT,
            ]
        );

        return $response->toArray();
    }

    public function getTotalGames(string $accessToken): int
    {
        $limit = 500;
        $offset = 0;
        $totalCount = 0;

        $headers = [
            'Client-ID' => $this->clientId,
            'Authorization' => 'Bearer '.$accessToken,
            'Accept' => 'application/json',
        ];

        while (true) {
            $response = $this->httpClient->request(
                'POST',
                'https://api.igdb.com/v4/games',
                [
                    'headers' => $headers,
                    'body' => sprintf('fields id; limit %d; offset %d;', $limit, $offset),
                ]
            );

            $data = $response->toArray();
            $batchCount = count($data);

            if (0 === $batchCount) {
                break;
            }

            $totalCount += $batchCount;
            $offset += $limit;
        }

        return $totalCount;
    }
}
