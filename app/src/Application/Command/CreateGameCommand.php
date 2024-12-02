<?php

declare(strict_types=1);

namespace App\Application\Command;

use Symfony\Component\Uid\Uuid;

final readonly class CreateGameCommand
{
    public function __construct(
        public Uuid $id,
        public string $title,
    ) {}
}
