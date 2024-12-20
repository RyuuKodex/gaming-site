<?php

declare(strict_types=1);

namespace App\Tests\User\Infrastructure\AccountManager\Client\Response;

use App\User\Domain\Enum\IdentifierType;
use App\User\Domain\Enum\UserRole;
use App\User\Infrastructure\AccountManager\Client\Response\IdentifierResponse;
use App\User\Infrastructure\AccountManager\Client\Response\UserDataResponse;
use PHPUnit\Framework\TestCase;

final class UserDataResponseTest extends TestCase
{
    public function testCreate(): void
    {
        $userData = new UserDataResponse(
            'John Doe',
            new IdentifierResponse(
                IdentifierType::Email,
                'test@example.pl'
            ),
            [UserRole::User->value, UserRole::Admin->value]
        );

        $this->assertSame('John Doe', $userData->getName());
        $this->assertSame(IdentifierType::Email, $userData->getIdentifier()->getType());
        $this->assertSame('test@example.pl', $userData->getIdentifier()->getValue());
        $this->assertSame([UserRole::User->value, UserRole::Admin->value], $userData->getRoles());
    }
}
