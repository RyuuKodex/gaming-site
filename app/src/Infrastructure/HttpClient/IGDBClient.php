<?php

declare(strict_types=1);

namespace App\Infrastructure\HttpClient;

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
                'body' => "fields name; limit {$limit}; offset {$offset};",
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
