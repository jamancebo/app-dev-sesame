<?php

declare(strict_types=1);

namespace DevSesame\Signings\Application\Command\Handler;

use DateTime;
use DateTimeZone;
use DevSesame\Signings\Application\Command\RemoveUser;
use DevSesame\Signings\Domain\Entity\User;
use DevSesame\Signings\Domain\Repository\UserRepository;
use DevSesame\Signings\Domain\ValueObject\Email;
use DevSesame\Signings\Domain\ValueObject\Id;
use DevSesame\Signings\Domain\ValueObject\Name;
use Exception;

class RemoveUserHandler
{
    private UserRepository $repository;

    /**
     * CreateUserHandler constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param RemoveUser $command
     * @return void
     * @throws Exception
     */
    public function handle(RemoveUser $command): void
    {
        $foundUser = $this->repository->find(
            Id::fromString($command->id())
        );

        if ($foundUser === null) {
            throw new Exception("User not found");
        }
        $today = new DateTime();
        $today->setTimezone(new DateTimeZone('Europe/Madrid'));
        $foundUser->update(
            $foundUser->createdAt(),
            $foundUser->updatedAt(),
            DateTime::createFromFormat('d/m/Y H:i:s', $today->format('d/m/Y H:i:s')),
            $foundUser->name(),
            $foundUser->email()
        );

        $this->repository->create($foundUser);
    }
}
