<?php

declare(strict_types=1);

namespace App\User\Domain\Entity;

use App\User\Domain\Enum\UserRole;
use App\User\Infrastructure\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private Uuid $id;

    #[ORM\Column]
    private string $name;

    #[ORM\Column]
    private string $identifier;

    #[ORM\Column(type: 'text')]
    private string $token;

    /** @var string[] */
    #[ORM\Column(type: 'json')]
    private array $roles = [];

    /** @param UserRole[] $roles */
    public function __construct(Uuid $id, string $name, string $identifier, string $token, array $roles)
    {
        $this->id = $id;
        $this->name = $name;
        $this->identifier = $identifier;
        $this->token = $token;
        $this->roles = [];

        foreach ($roles as $role) {
            $this->addRole($role);
        }
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUserIdentifier(): string
    {
        return $this->identifier;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function updateToken(string $token): void
    {
        $this->token = $token;
    }

    /** @return string[] */
    public function getRoles(): array
    {
        return $this->roles;
    }

    public function addRole(UserRole $role): void
    {
        $this->roles = array_unique([...$this->getRoles(), $role->value]);
    }

    /** @return UserRole[] */
    public function listRoles(): array
    {
        return array_map(fn (string $roleAsString) => UserRole::from($roleAsString), $this->roles);
    }

    public function eraseCredentials(): void {}
}
