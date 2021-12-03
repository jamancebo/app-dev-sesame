<?php

declare(strict_types=1);

namespace DevSesame\Signings\Application\Command\Handler;

use DateTime;
use DevSesame\Shared\Domain\Criteria\Criteria;
use DevSesame\Shared\Domain\Criteria\Filters;
use DevSesame\Signings\Application\Command\CreateUser;
use DevSesame\Signings\Domain\Entity\User;
use DevSesame\Signings\Domain\Repository\UserRepository;
use DevSesame\Signings\Domain\ValueObject\Email;
use DevSesame\Signings\Domain\ValueObject\Id;
use DevSesame\Signings\Domain\ValueObject\Name;
use Exception;

class CreateUserHandler
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
     * @param CreateUser $command
     * @return User
     * @throws UserRepository|Exception
     */
    public function handle(CreateUser $command): User
    {
        $filters = ['id' => $command->id()];
        $criteria = Criteria::create(Filters::fromValues($filters));

        $foundUser = $this->repository->findBy($criteria);

        if (!empty($foundUser)) {
            throw new Exception("User already created");
        }


        $user = User::instantiate(
            Id::fromString($command->id()),
            DateTime::createFromFormat('d/m/Y H:i:s', $command->createdAt()),
            DateTime::createFromFormat('d/m/Y H:i:s', $command->updatedAt()),
            null,
            Name::fromString($command->name()),
            Email::fromString($command->email())
        );

        $this->repository->create($user);

        return $user;
    }
}
