<?php

declare(strict_types=1);

namespace DevSesame\Signings\Application\Command\Handler;

use DevSesame\Shared\Domain\Criteria\Criteria;
use DevSesame\Shared\Domain\Criteria\Filters;
use DevSesame\Signings\Application\Command\FindAllUsers;
use DevSesame\Signings\Domain\Repository\UserRepository;
use Exception;

class FindAllUsersHandler
{
    private UserRepository $repository;

    /**
     * FindPilotHandler constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param FindAllUsers $command
     * @return array
     * @throws Exception
     */
    public function handle(FindAllUsers $command): array
    {
        $criteria = Criteria::create(new Filters([]));
        $users = $this->repository->findBy($criteria);
        $result = [];

        if (empty($users)) {
            throw new Exception("Not users found", 404);
        }

        foreach ($users as $user) {
            if ($user->deletedAt() === null) {
                $result[] =  $user;
            }
        }

        return $result;
    }
}
