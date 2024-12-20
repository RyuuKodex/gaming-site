<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Fixtures;

use App\User\Domain\Entity\User;
use App\User\Domain\Enum\UserRole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User(
            Uuid::fromString('d67b1332-29e9-4f40-837c-3d97326595d9'),
            'John Doe',
            'johndoe@example.com',
            'token',
            [UserRole::User, UserRole::Admin]
        );

        $user2 = new User(
            Uuid::fromString('67e4bc97-3225-4d09-86e3-aa7a99ea97ca'),
            'Stan Doe',
            'standoe@example.com',
            'token',
            [UserRole::User]
        );

        $user3 = new User(
            Uuid::fromString('582d52d6-22c4-4c79-83a2-228524399112'),
            'Emile Doe',
            'emiledoe@example.com',
            'token',
            [UserRole::User]
        );

        $manager->persist($user);
        $this->addReference('john-doe', $user);

        $manager->persist($user2);
        $this->addReference('stan-doe', $user2);

        $manager->persist($user3);
        $this->addReference('emile-doe', $user3);

        $manager->flush();
    }
}
