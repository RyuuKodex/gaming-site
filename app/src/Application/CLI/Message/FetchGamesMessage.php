<?php

declare(strict_types=1);

namespace App\Application\CLI\Message;

final readonly class FetchGamesMessage
{
    public function __construct(public int $offset, public int $limit, public string $accessToken) {}
}
