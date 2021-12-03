<?php

declare(strict_types=1);

namespace DevSesame\Signings\Application\Command\Handler;

use DateTime;
use DevSesame\Signings\Application\Command\CreateWorkEntry;
use DevSesame\Signings\Domain\Entity\WorkEntry;
use DevSesame\Signings\Domain\Repository\UserRepository;
use DevSesame\Signings\Domain\Repository\WorkEntryRepository;
use DevSesame\Signings\Domain\ValueObject\Id;
use Exception;

class CreateWorkEntryHandler
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
     * @param CreateWorkEntry $command
     * @return WorkEntry
     * @throws Exception
     */
    public function handle(CreateWorkEntry $command): WorkEntry
    {
        $endDate = null;

        $foundUser = $this->userRepository->find(Id::fromString($command->userId()));

        if ($foundUser === null) {
            throw new Exception("User not exist created", 404);
        }

        $startDate = DateTime::createFromFormat('d/m/Y H:i:s', $command->startDate());
        if ($command->endDate() !== null) {
            $endDate = DateTime::createFromFormat('d/m/Y H:i:s', $command->endDate());
            if ($endDate < $startDate) {
                throw new Exception("Enddate must be later than startDate", 404);
            }
        }

        $workEntry = WorkEntry::instantiate(
            Id::random(),
            Id::fromString($command->userId()),
            DateTime::createFromFormat('d/m/Y H:i:s', $command->createdAt()),
            DateTime::createFromFormat('d/m/Y H:i:s', $command->updatedAt()),
            null,
            $startDate,
            $endDate
        );

        $this->workEntryrepository->create($workEntry);

        return $workEntry;
    }
}
