<?php

declare(strict_types=1);

namespace DevSesame\Tests\Unit\Signings\Domain\Entity;

use DevSesame\Signings\Domain\Entity\WorkEntry;
use DevSesame\Tests\Mother\Signings\Domain\ValueObject\IdMother;
use DevSesame\Tests\Unit\Signings\Infrastructure\PhpUnit\ModuleUnitCase;
use Faker\Factory;

class WorkEntryTest extends ModuleUnitCase
{
    public function testIniciate()
    {
        $faker = Factory::create('es_ES');
        $id = IdMother::random();
        $userId = IdMother::random();
        $createdAt = $faker->datetime();
        $updatedAt = $faker->datetime();
        $deletedAt = $faker->datetime();
        $startDate = $faker->datetime();
        $endDate = $faker->datetime();

        $user = WorkEntry::instantiate(
            $id,
            $userId,
            $createdAt,
            $updatedAt,
            $deletedAt,
            $startDate,
            $endDate
        );

        $this->assertInstanceOf(WorkEntry::class, $user);
        $this->assertEquals($id, $user->id());
        $this->assertEquals($userId, $user->userId());
        $this->assertEquals($createdAt, $user->createdAt());
        $this->assertEquals($updatedAt, $user->updatedAt());
        $this->assertEquals($deletedAt, $user->deletedAt());
        $this->assertEquals($startDate, $user->startDate());
        $this->assertEquals($endDate, $user->endDate());
    }
}
