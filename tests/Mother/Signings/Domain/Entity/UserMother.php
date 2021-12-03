<?php

declare(strict_types=1);

namespace DevSesame\Tests\Mother\Signings\Domain\Entity;

use DateTime;
use DevSesame\Signings\Domain\Entity\User;
use DevSesame\Signings\Domain\ValueObject\Email;
use DevSesame\Signings\Domain\ValueObject\Id;
use DevSesame\Signings\Domain\ValueObject\Name;
use DevSesame\Tests\Mother\Signings\Domain\ValueObject\EmailMother;
use DevSesame\Tests\Mother\Signings\Domain\ValueObject\IdMother;
use DevSesame\Tests\Mother\Signings\Domain\ValueObject\NameMother;
use Faker\Factory;

class UserMother
{

    public static function create(
        Id $id,
        DateTime $createdAt,
        DateTime $updatedAt,
        ?DateTime $deletedAt,
        Name $name,
        Email $email
    ): User {
        return User::instantiate($id, $createdAt, $updatedAt, $deletedAt, $name,$email);
    }

    /**
     * @return User
     */
    public static function random(): User
    {
        $faker = Factory::create('es_ES');
        return self::create(
            IdMother::random(),
            $faker->datetime(),
            $faker->datetime(),
            $faker->datetime(),
            NameMother::random(),
            EmailMother::random()
        );
    }

}
