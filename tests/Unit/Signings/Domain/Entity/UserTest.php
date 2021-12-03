<?php

declare(strict_types=1);

namespace DevSesame\Tests\Unit\Signings\Domain\Entity;

use DevSesame\Signings\Domain\Entity\User;
use DevSesame\Tests\Mother\Signings\Domain\ValueObject\EmailMother;
use DevSesame\Tests\Mother\Signings\Domain\ValueObject\IdMother;
use DevSesame\Tests\Mother\Signings\Domain\ValueObject\NameMother;
use DevSesame\Tests\Unit\Signings\Infrastructure\PhpUnit\ModuleUnitCase;
use Faker\Factory;

class UserTest extends ModuleUnitCase
{
    public function testIniciate()
    {
        $faker = Factory::create('es_ES');
        $id = IdMother::random();
        $createdAt = $faker->datetime();
        $updatedAt = $faker->datetime();
        $deletedAt = $faker->datetime();
        $name = NameMother::random();
        $email = EmailMother::random();

        $user = User::instantiate(
            $id,
            $createdAt,
            $updatedAt,
            $deletedAt,
            $name,
            $email
        );

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($id, $user->id());
        $this->assertEquals($createdAt, $user->createdAt());
        $this->assertEquals($updatedAt, $user->updatedAt());
        $this->assertEquals($deletedAt, $user->deletedAt());
        $this->assertEquals($name, $user->name());
        $this->assertEquals($email, $user->email());
    }
}
