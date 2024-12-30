<?php

declare(strict_types=1);

namespace App\User\Application\Command;

use App\User\Domain\Enum\UserRole;
use Symfony\Component\Uid\Uuid;

final readonly class CreateUserCommand
{
    /** @param UserRole[] $roles */
    public function __construct(
        public Uuid $id,
        public string $name,
        public string $identifier,
        public string $token,
        public array $roles
    ) {}
}
