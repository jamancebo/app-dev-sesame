<?php

declare(strict_types=1);

namespace DevSesame\Signings\Infrastructure\Repository\Persistence;

use DevSesame\Shared\Domain\Criteria\Criteria;
use DevSesame\Shared\Infrastructure\Repository\Doctrine\DoctrineRepository;
use DevSesame\Signings\Domain\Entity\WorkEntry;
use DevSesame\Signings\Domain\Repository\WorkEntryRepository;
use DevSesame\Signings\Domain\ValueObject\Id;
use Doctrine\ORM\EntityManager;

class MysqlEntryWorkRepository extends DoctrineRepository implements WorkEntryRepository
{
    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
    }

    /**
     * @inheritDoc
     */
    public function create(WorkEntry $workEntry): void
    {
        $this->persist($workEntry);
    }

    /**
     * @inheritDoc
     */
    public function find(Id $id): ?WorkEntry
    {
        return $this->entityManager->find(WorkEntry::class, $id->value());
    }

    /**
     * @inheritDoc
     */
    public function findBy(Criteria $criteria): array
    {
        return $this->repository(WorkEntry::class)->findBy(
            $criteria->plainFilters(),
            $criteria->plainOrders(),
            $criteria->limit(),
            $criteria->offset()
        );
    }

    /**
     * @inheritDoc
     */
    public function update(WorkEntry $workEntry): void
    {
        $this->persist($workEntry);
    }

    /**
     * @inheritDoc
     */
    public function delete(WorkEntry $workEntry): void
    {
        $this->remove($workEntry);
    }
}
