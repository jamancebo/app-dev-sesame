<?php

declare(strict_types=1);

namespace DevSesame\Signings\Application\Command\Handler;

use DevSesame\Signings\Application\Command\FindWorkEntry;
use DevSesame\Signings\Domain\Entity\WorkEntry;
use DevSesame\Signings\Domain\Repository\WorkEntryRepository;
use DevSesame\Signings\Domain\ValueObject\Id;
use Exception;

class FindWorkEntryHandler
{
    private WorkEntryRepository $workEntryrepository;

    /**
     * constructor.
     * @param WorkEntryRepository $workEntryrepository
     */
    public function __construct(WorkEntryRepository $workEntryrepository)
    {
        $this->workEntryrepository = $workEntryrepository;
    }

    /**
     * @param FindWorkEntry $command
     * @return WorkEntry
     * @throws Exception
     */
    public function handle(FindWorkEntry $command): WorkEntry
    {
        $foundWorkEntry = $this->workEntryrepository->find(
            Id::fromString($command->id())
        );

        if ($foundWorkEntry->deletedAt() !== null) {
            throw new Exception("Registry deleted at " . $foundWorkEntry->deletedAt()->format('d/m/Y H:i:s'), 404);
        }

        if ($foundWorkEntry === null) {
            throw new Exception("WorkEntry not exist");
        }

        return $foundWorkEntry;
    }
}
