<?php

namespace DevSesame\Signings\Application\Command\Handler;

use DateTime;
use DevSesame\Signings\Application\Command\UpdateWorkEntry;
use DevSesame\Signings\Domain\Entity\WorkEntry;
use DevSesame\Signings\Domain\Repository\UserRepository;
use DevSesame\Signings\Domain\Repository\WorkEntryRepository;
use DevSesame\Signings\Domain\ValueObject\Id;
use Exception;

class UpdateWorkEntryHandler
{
    private WorkEntryRepository $workEntryrepository;
    private UserRepository $userRepository;

    /**
     * constructor.
     * @param WorkEntryRepository $workEntryrepository
     * @param UserRepository $userRepository
     */
    public function __construct(WorkEntryRepository $workEntryrepository, UserRepository $userRepository)
    {
        $this->workEntryrepository = $workEntryrepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param UpdateWorkEntry $command
     * @return WorkEntry
     * @throws Exception
     */
    public function handle(UpdateWorkEntry $command): WorkEntry
    {
        $endDate = null;

        $foundUser = $this->userRepository->find(
            Id::fromString($command->userId())
        );

        if ($foundUser === null) {
            throw new Exception("User not exist created");
        }

        $foundWorkEntry = $this->workEntryrepository->find(
            Id::fromString($command->id())
        );

        if ($foundWorkEntry === null) {
            throw new Exception("User not exist created");
        }

        if ($command->endDate() !== null) {
            $endDate = DateTime::createFromFormat('d/m/Y H:i:s', $command->endDate());
        }

        $foundWorkEntry->update(
            Id::fromString($command->userId()),
            DateTime::createFromFormat('d/m/Y H:i:s', $command->createdAt()),
            DateTime::createFromFormat('d/m/Y H:i:s', $command->updatedAt()),
            null,
            DateTime::createFromFormat('d/m/Y H:i:s', $command->startDate()),
            $endDate
        );

        $this->workEntryrepository->update($foundWorkEntry);

        return $foundWorkEntry;
    }
}
