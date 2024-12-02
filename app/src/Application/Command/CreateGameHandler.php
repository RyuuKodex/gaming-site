<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\Entity\Game;
use App\Domain\Repository\GameStore;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class CreateGameHandler
{
    public function __construct(private GameStore $gameStore) {}

    public function __invoke(CreateGameCommand $command): void
    {
        $game = new Game($command->id, $command->title);

        $this->gameStore->save($game);
    }
}
