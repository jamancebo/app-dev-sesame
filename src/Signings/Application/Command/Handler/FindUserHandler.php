<?php

declare(strict_types=1);

namespace DevSesame\Signings\Application\Command\Handler;

use DevSesame\Signings\Domain\Repository\UserRepository;
use DevSesame\Signings\Application\Command\FindUser;
use DevSesame\Signings\Domain\Entity\User;
use DevSesame\Signings\Domain\ValueObject\Id;
use Exception;

class FindUserHandler
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
     * @param FindUser $command
     * @return User
     * @throws Exception
     */
    public function handle(FindUser $command): User
    {
        $user = $this->repository->find(
            Id::fromString($command->id())
        );

        if ($user === null) {
            throw new Exception("No User found", 404);
        }

        if ($user->deletedAt() !== null) {
            throw new Exception("User deleted", 404);
        }

        return $user;
    }
}
