<?php

declare(strict_types=1);

namespace DevSesame\Signings\Application\Command\Handler;

use DateTime;
use DateTimeZone;
use DevSesame\Signings\Application\Command\RemoveWorkEntry;
use DevSesame\Signings\Domain\Entity\WorkEntry;
use DevSesame\Signings\Domain\Repository\WorkEntryRepository;
use DevSesame\Signings\Domain\ValueObject\Id;
use Exception;

class RemoveWorkEntryHandler
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
     * @param RemoveWorkEntry $command
     * @return WorkEntry
     * @throws Exception
     */
    public function handle(RemoveWorkEntry $command): WorkEntry
    {
        $foundWorkEntry = $this->workEntryrepository->find(
            Id::fromString($command->id())
        );

        if ($foundWorkEntry === null) {
            throw new Exception("WorkEntry not exist");
        }

        $today = new DateTime();
        $today->setTimezone(new DateTimeZone('Europe/Madrid'));

        $foundWorkEntry->update(
            $foundWorkEntry->userId(),
            $foundWorkEntry->createdAt(),
            $foundWorkEntry->updatedAt(),
            DateTime::createFromFormat('d/m/Y H:i:s', $today->format('d/m/Y H:i:s')),
            $foundWorkEntry->startDate(),
            $foundWorkEntry->endDate()
        );

        $this->workEntryrepository->update($foundWorkEntry);

        return $foundWorkEntry;
    }
}
