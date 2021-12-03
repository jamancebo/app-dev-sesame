<?php

declare(strict_types=1);

namespace DevSesame\Tests\Integration\Signings\Infrastructure\DataFixtures;

use DevSesame\Signings\Domain\Repository\WorkEntryRepository;
use DevSesame\Tests\Mother\Signings\Domain\Entity\WorkEntryMother;
use DevSesame\Tests\Mother\Signings\Domain\ValueObject\IdMother;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class WorkEntryFixture  implements FixtureInterface
{
    public const ID = '023b5652-c1c0-33ad-8cde-84f6aeae84e1';
    public const USERID = '023b5652-c1c0-33ad-8cde-84f6aeae84e2';
    /**
     * @var WorkEntryRepository
     */
    private WorkEntryRepository $repository;

    /**
     * @param WorkEntryRepository $repository
     */
    public function __construct(WorkEntryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('es_ES');
        $id = IdMother::create(self::ID);
        $userId = IdMother::create(self::USERID);
        $createdAt = $faker->datetime();
        $updatedAt = $faker->datetime();
        $deletedAt = $faker->datetime();
        $startDate = $faker->datetime();
        $endDate = $faker->datetime();

        $workEntry = WorkEntryMother::create(
            $id,
            $userId,
            $createdAt,
            $updatedAt,
            $deletedAt,
            $startDate,
            $endDate
        );

        $this->repository->create($workEntry);
    }
}
