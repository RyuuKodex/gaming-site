<?php

declare(strict_types=1);

namespace App\Infrastructure\HttpClient;

use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class IGDBClient
{
    public function __construct(private HttpClientInterface $httpClient, private string $clientId, private TwitchClient $twitchClient)
    {
    }

    public function getGames()
    {
        $accessToken = $this->twitchClient->fetchToken();

        $headers = [
            'Client-ID' => $this->clientId,
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept' => 'application/json',
        ];

        $response = $this->httpClient->request(
            'POST',
            'https://api.igdb.com/v4/games',
            [
                'headers' => $headers,
                'body' => 'fields name, summary; limit 100; search "Baldurs Gate";',
            ]
        );

        dd($response->toArray());

        return $response->toArray();
    }
}
