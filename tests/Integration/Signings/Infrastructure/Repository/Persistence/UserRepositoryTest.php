<?php

declare(strict_types=1);

namespace DevSesame\Tests\Integration\Signings\Infrastructure\Repository\Persistence;

use DateTime;
use DevSesame\Shared\Domain\Criteria\Criteria;
use DevSesame\Shared\Domain\Criteria\Filters;
use DevSesame\Signings\Domain\Entity\User;
use DevSesame\Signings\Domain\ValueObject\Email;
use DevSesame\Signings\Domain\ValueObject\Id;
use DevSesame\Signings\Domain\ValueObject\Name;
use DevSesame\Tests\Integration\Signings\Infrastructure\PhpUnit\ModuleIntegrationTestCase;
use DevSesame\Tests\Mother\Signings\Domain\Entity\UserMother;

class UserRepositoryTest extends ModuleIntegrationTestCase
{
    public function testFindAndCreate()
    {
        $user = UserMother::random();
        $this->userRepository()->create($user);

        $createdUser = $this->userRepository()->find($user->id());

        $this->assertIsObject($createdUser);
        $this->assertInstanceOf(User::class, $createdUser);

        $this->assertInstanceOf(Id::class, $createdUser->id());
        $this->assertInstanceOf(DateTime::class, $createdUser->createdAt());
        $this->assertInstanceOf(DateTime::class, $createdUser->updatedAt());
        $this->assertInstanceOf(DateTime::class, $createdUser->deletedAt());
        $this->assertInstanceOf(Name::class, $createdUser->name());
        $this->assertInstanceOf(Email::class, $createdUser->email());

        $this->assertEquals($createdUser->id(), $user->id());
        $this->assertEquals($createdUser->createdAt(), $user->createdAt());
        $this->assertEquals($createdUser->updatedAt(), $user->updatedAt());
        $this->assertEquals($createdUser->deletedAt(), $user->deletedAt());
        $this->assertEquals($createdUser->name(), $user->name());
        $this->assertEquals($createdUser->email(), $user->email());
    }

    public function testFindBy()
    {
        $criteria = Criteria::create(new Filters([]));
        $users = $this->userRepository()->findBy($criteria);

        foreach ($users as $user) {
            $this->assertInstanceOf(Id::class, $user->id());
            $this->assertInstanceOf(DateTime::class, $user->createdAt());
            $this->assertInstanceOf(DateTime::class, $user->updatedAt());
            $this->assertInstanceOf(DateTime::class, $user->deletedAt());
            $this->assertInstanceOf(Name::class, $user->name());
            $this->assertInstanceOf(Email::class, $user->email());

        }
    }
}
