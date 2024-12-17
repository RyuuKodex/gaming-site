<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\HttpClient;

use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class TwitchClient
{
    public function __construct(private HttpClientInterface $httpClient, private string $clientId, private string $clientSecret) {}

    public function fetchToken(): string
    {
        $response = $this->httpClient->request(
            'POST',
            'https://id.twitch.tv/oauth2/token',
            [
                'body' => [
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'grant_type' => 'client_credentials',
                ],
            ]
        );

        return $response->toArray()['access_token'];
    }
}
