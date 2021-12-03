<?php

declare(strict_types=1);

namespace DevSesame\Tests\Mother\Signings\Domain\ValueObject;

use DevSesame\Signings\Domain\ValueObject\Name;
use Faker\Factory;

class NameMother
{
    /**
     * @param string $name
     * @return Name
     */
    public static function create(string $name): Name
    {
        return Name::fromString($name);
    }

    /**
     * @return Name
     */
    public static function random(): Name
    {
        $faker = Factory::create('es_ES');
        return self::create($faker->name());
    }
}
