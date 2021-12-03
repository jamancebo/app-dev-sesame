<?php

declare(strict_types=1);

namespace DevSesame\Tests\Mother\Signings\Domain\ValueObject;

use DevSesame\Signings\Domain\ValueObject\Email;
use Faker\Factory;

class EmailMother
{
    /**
     * @param string $name
     * @return Email
     */
    public static function create(string $name): Email
    {
        return Email::fromString($name);
    }

    /**
     * @return Email
     */
    public static function random(): Email
    {
        $faker = Factory::create('es_ES');
        return self::create($faker->name());
    }
}
