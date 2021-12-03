<?php

declare(strict_types=1);

namespace DevSesame\Signings\Application\Command\Handler;

use DevSesame\Shared\Domain\Criteria\Criteria;
use DevSesame\Shared\Domain\Criteria\Filters;
use DevSesame\Signings\Application\Command\FindUserWorkEntry;
use DevSesame\Signings\Domain\Repository\UserRepository;
use DevSesame\Signings\Domain\Repository\WorkEntryRepository;
use DevSesame\Signings\Domain\ValueObject\Id;
use Exception;

class FindUserWorkEntryHandler
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
     * @param FindUserWorkEntry $command
     * @return array
     * @throws Exception
     */
    public function handle(FindUserWorkEntry $command): array
    {
        $filters = ['userId' => $command->userId()];
        $criteria = Criteria::create(Filters::fromValues($filters));
        $result = [];

        $foundUser = $this->userRepository->find(
            Id::fromString($command->userId())
        );

        if ($foundUser === null) {
            throw new Exception("User not exist");
        }

        if ($foundUser->deletedAt() !== null) {
            throw new Exception("User deleted at " . $foundUser->deletedAt()->format('d/m/Y H:i:s'), 404);
        }

        $foundWorkEntry = $this->workEntryrepository->findBy($criteria);

        if (empty($foundWorkEntry)) {
            throw new Exception("WorkEntry not exist");
        }

        foreach ($foundWorkEntry as $workEntry) {
            if ($workEntry->deletedAt() === null) {
                $result[] =  $workEntry;
            }
        }

        return $result;
    }
}
