<?php

declare(strict_types=1);

namespace App\Tests\User\Application\Command;

use App\User\Application\Command\CreateUserCommand;
use App\User\Application\Command\CreateUserHandler;
use App\User\Domain\Entity\User;
use App\User\Domain\Enum\UserRole;
use App\User\Domain\Repository\UserStoreInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

final class CreateUserHandlerTest extends TestCase
{
    public function testHandler(): void
    {
        $userStore = $this->createMock(UserStoreInterface::class);

        $userStore
            ->expects(self::once())
            ->method('save')
            ->with(self::callback(
                fn (User $user) => (
                    $user->getId()->equals(Uuid::fromString('92eac78d-2d52-4c78-b831-6e8ba80c7982'))
                && 'name' === $user->getName()
                && 'id' === $user->getUserIdentifier()
                && 'someToken' === $user->getToken()
                && [UserRole::User->value] === $user->getRoles()
                )
            ))
        ;

        $handler = new CreateUserHandler($userStore);
        $command = new CreateUserCommand(
            Uuid::fromString('92eac78d-2d52-4c78-b831-6e8ba80c7982'),
            'name',
            'id',
            'someToken',
            [UserRole::User]
        );

        $handler($command);
    }
}
