<?php

declare(strict_types=1);

namespace App\User\Infrastructure\AccountManager\Client\Response;

final readonly class UserDataResponse implements UserDataResponseInterface
{
    /**
     * @param array<int, string> $roles
     */
    public function __construct(private string $name, private IdentifierResponse $identifier, private array $roles) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getIdentifier(): IdentifierResponse
    {
        return $this->identifier;
    }

    /**
     * @return array<int, string>
     */
    public function getRoles(): array
    {
        return $this->roles;
    }
}
