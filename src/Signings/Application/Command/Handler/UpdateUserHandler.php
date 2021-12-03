<?php

declare(strict_types=1);

namespace DevSesame\Signings\Application\Command\Handler;

use DateTime;
use DevSesame\Signings\Application\Command\UpdateUser;
use DevSesame\Signings\Domain\Repository\UserRepository;
use DevSesame\Signings\Domain\ValueObject\Email;
use DevSesame\Signings\Domain\ValueObject\Id;
use DevSesame\Signings\Domain\ValueObject\Name;
use Exception;

class UpdateUserHandler
{
    private UserRepository $repository;

    /**
     * UpdateUserHandler constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UpdateUser $command
     * @throws UserRepository|Exception
     */
    public function handle(UpdateUser $command): void
    {

        $foundUser = $this->repository->find(
            Id::fromString($command->id())
        );

        if ($foundUser === null) {
            throw new Exception("User has not been created");
        }

        $foundUser->update(
            DateTime::createFromFormat('d/m/Y H:i:s', $command->createdAt()),
            DateTime::createFromFormat('d/m/Y H:i:s', $command->updatedAt()),
            null,
            Name::fromString($command->name()),
            Email::fromString($command->email())
        );

        $this->repository->update($foundUser);
    }
}
