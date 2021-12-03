<?php

declare(strict_types=1);

namespace DevSesame\Signings\Domain\Repository;

use DevSesame\Shared\Domain\Criteria\Criteria;
use DevSesame\Signings\Domain\Entity\User;
use DevSesame\Signings\Domain\ValueObject\Id;
use Exception;

interface UserRepository
{
    /**
     * @param User $user
     */
    public function create(User $user): void;

    /**
     * @param Id $id
     * @throws Exception
     * @return User|null
     */
    public function find(Id $id): ?User;

    /**
     * @param Criteria $criteria
     * @return User[]
     */
    public function findBy(Criteria $criteria): array;

    /**
     * @param User $user
     */
    public function update(User $user): void;

    /**
     * @param User $user
     * @return void
     * @throws Exception
     */
    public function delete(User $user): void;
}
