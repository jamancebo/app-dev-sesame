<?php

declare(strict_types=1);

namespace DevSesame\Tests\Mother\Signings\Domain\Entity;


use DateTime;
use DevSesame\Signings\Domain\Entity\WorkEntry;
use DevSesame\Signings\Domain\ValueObject\Id;
use DevSesame\Tests\Mother\Signings\Domain\ValueObject\IdMother;
use Faker\Factory;

class WorkEntryMother
{
    public static function create(
        Id $id,
        Id $userId,
        DateTime $createdAt,
        DateTime $updatedAt,
        ?DateTime $deletedAt,
        DateTime $startDate,
        ?DateTime $endDate
    ): WorkEntry {
        return WorkEntry::instantiate($id,$userId, $createdAt, $updatedAt, $deletedAt, $startDate,$endDate);
    }

    /**
     * @return WorkEntry
     */
    public static function random(): WorkEntry
    {
        $faker = Factory::create('es_ES');
        return self::create(
            IdMother::random(),
            IdMother::random(),
            $faker->datetime(),
            $faker->datetime(),
            $faker->datetime(),
            $faker->datetime(),
            $faker->datetime()
        );
    }

}
