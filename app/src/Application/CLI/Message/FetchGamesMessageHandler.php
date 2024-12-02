<?php

declare(strict_types=1);

namespace App\Application\CLI\Message;

use App\Domain\Entity\Game;
use App\Domain\Repository\GameStore;
use App\Infrastructure\HttpClient\IGDBClient;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
final readonly class FetchGamesMessageHandler
{
    public function __construct(private IGDBClient $client, private GameStore $gameStore) {}

    public function __invoke(FetchGamesMessage $message): void
    {
        $games = $this->client->getGames($message->limit, $message->offset, $message->accessToken);

        foreach ($games as $game) {
            $gameDb = new Game(Uuid::v4(), $game['name']);
            $this->gameStore->save($gameDb);
        }
    }
}
