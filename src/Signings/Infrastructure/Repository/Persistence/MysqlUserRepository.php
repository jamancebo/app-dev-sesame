<?php

declare(strict_types=1);

namespace DevSesame\Signings\Infrastructure\Repository\Persistence;

use DevSesame\Signings\Domain\Repository\UserRepository;
use DevSesame\Shared\Domain\Criteria\Criteria;
use DevSesame\Shared\Infrastructure\Repository\Doctrine\DoctrineRepository;
use DevSesame\Signings\Domain\Entity\User;
use DevSesame\Signings\Domain\ValueObject\Id;
use Doctrine\ORM\EntityManager;

class MysqlUserRepository extends DoctrineRepository implements UserRepository
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
    public function create(User $user): void
    {
        $this->persist($user);
    }

    /**
     * @inheritDoc
     */
    public function find(Id $id): ?User
    {
        return $this->entityManager->find(User::class, $id->value());
    }

    /**
     * @inheritDoc
     */
    public function findBy(Criteria $criteria): array
    {
        return $this->repository(User::class)->findBy(
            $criteria->plainFilters(),
            $criteria->plainOrders(),
            $criteria->limit(),
            $criteria->offset()
        );
    }

    /**
     * @inheritDoc
     */
    public function update(User $user): void
    {
        $this->persist($user);
    }

    /**
     * @inheritDoc
     */
    public function delete(User $user): void
    {
        $this->remove($user);
    }
}
