<?php

declare(strict_types=1);

namespace DevSesame\Tests\Integration\Signings\Infrastructure\Repository\Persistence;

use DateTime;
use DevSesame\Shared\Domain\Criteria\Criteria;
use DevSesame\Shared\Domain\Criteria\Filters;
use DevSesame\Signings\Domain\Entity\WorkEntry;
use DevSesame\Signings\Domain\ValueObject\Id;
use DevSesame\Tests\Integration\Signings\Infrastructure\PhpUnit\ModuleIntegrationTestCase;
use DevSesame\Tests\Mother\Signings\Domain\Entity\WorkEntryMother;

class WorkEntryRepositoryTest extends ModuleIntegrationTestCase
{
    public function testFindAndCreate()
    {
        $workEntry = WorkEntryMother::random();
        $this->workEntryRepository()->create($workEntry);

        $createdWorkEntry = $this->workEntryRepository()->find($workEntry->id());

        $this->assertIsObject($createdWorkEntry);
        $this->assertInstanceOf(WorkEntry::class, $createdWorkEntry);

        $this->assertInstanceOf(Id::class, $createdWorkEntry->id());
        $this->assertInstanceOf(Id::class, $createdWorkEntry->userId());
        $this->assertInstanceOf(DateTime::class, $createdWorkEntry->createdAt());
        $this->assertInstanceOf(DateTime::class, $createdWorkEntry->updatedAt());
        $this->assertInstanceOf(DateTime::class, $createdWorkEntry->deletedAt());
        $this->assertInstanceOf(DateTime::class, $createdWorkEntry->startDate());
        $this->assertInstanceOf(DateTime::class, $createdWorkEntry->endDate());

        $this->assertEquals($createdWorkEntry->id(), $workEntry->id());
        $this->assertEquals($createdWorkEntry->userId(), $workEntry->userId());
        $this->assertEquals($createdWorkEntry->createdAt(), $workEntry->createdAt());
        $this->assertEquals($createdWorkEntry->updatedAt(), $workEntry->updatedAt());
        $this->assertEquals($createdWorkEntry->deletedAt(), $workEntry->deletedAt());
        $this->assertEquals($createdWorkEntry->startDate(), $workEntry->startDate());
        $this->assertEquals($createdWorkEntry->endDate(), $workEntry->endDate());
    }

    public function testFindBy()
    {
        $criteria = Criteria::create(new Filters([]));
        $workEntries = $this->workEntryRepository()->findBy($criteria);

        foreach ($workEntries as $workEntry) {
            $this->assertInstanceOf(Id::class, $workEntry->id());
            $this->assertInstanceOf(Id::class, $workEntry->userId());
            $this->assertInstanceOf(DateTime::class, $workEntry->createdAt());
            $this->assertInstanceOf(DateTime::class, $workEntry->updatedAt());
            $this->assertInstanceOf(DateTime::class, $workEntry->deletedAt());
            $this->assertInstanceOf(DateTime::class, $workEntry->startDate());
            $this->assertInstanceOf(DateTime::class, $workEntry->endDate());

        }
    }
}
