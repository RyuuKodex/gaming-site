<?php

declare(strict_types=1);

namespace App\User\Infrastructure\AccountManager\Client\Response;

interface UserDataResponseInterface
{
    public function getName(): string;

    public function getIdentifier(): IdentifierResponseInterface;

    /**
     * @return array<int, string>
     */
    public function getRoles(): array;
}
