<?php

declare(strict_types=1);

namespace DevSesame\Signings\Domain\Repository;

use DevSesame\Shared\Domain\Criteria\Criteria;
use DevSesame\Signings\Domain\Entity\WorkEntry;
use DevSesame\Signings\Domain\ValueObject\Id;
use Exception;

interface WorkEntryRepository
{
    /**
     * @param WorkEntry $workEntry
     */
    public function create(WorkEntry $workEntry): void;

    /**
     * @param Id $id
     * @throws Exception
     * @return WorkEntry|null
     */
    public function find(Id $id): ?WorkEntry;

    /**
     * @param Criteria $criteria
     * @return WorkEntry[]
     */
    public function findBy(Criteria $criteria): array;

    /**
     * @param WorkEntry $workEntry
     */
    public function update(WorkEntry $workEntry): void;

    /**
     * @param WorkEntry $workEntry
     * @return void
     * @throws Exception
     */
    public function delete(WorkEntry $workEntry): void;
}
