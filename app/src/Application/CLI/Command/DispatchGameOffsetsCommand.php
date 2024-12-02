<?php

declare(strict_types=1);

namespace App\Application\CLI\Command;

use App\Application\CLI\Message\FetchGamesMessage;
use App\Infrastructure\HttpClient\IGDBClient;
use App\Infrastructure\HttpClient\TwitchClient;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(name: 'app:dispatch-game-offsets')]
final class DispatchGameOffsetsCommand extends Command
{
    public function __construct(private readonly MessageBusInterface $bus, private readonly IGDBClient $IGDBClient, private readonly TwitchClient $twitchClient)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $accessToken = $this->twitchClient->fetchToken();
        $totalGames = $this->IGDBClient->getTotalGames($accessToken);
        $limit = 500;

        for ($offset = 0; $offset < $totalGames; $offset += $limit) {
            $this->bus->dispatch(new FetchGamesMessage($offset, $limit, $accessToken));
        }

        $output->writeln('Dispatched all game offset messages.');

        return Command::SUCCESS;
    }
}
