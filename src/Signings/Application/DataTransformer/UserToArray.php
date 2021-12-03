<?php

declare(strict_types=1);

namespace DevSesame\Signings\Application\DataTransformer;

use DevSesame\Signings\Domain\Entity\User;
use DevSesame\Signings\Domain\ValueObject\Email;
use DevSesame\Signings\Domain\ValueObject\Id;
use DevSesame\Signings\Domain\ValueObject\Name;
use Exception;

class UserToArray
{
    /**
     * @param User $user
     * @return array
     */
    public function transform(User $user): array
    {
        return [
            'id' => $user->id()->value(),
            'createdAt' => $user->createdAt(),
            'updatedAt' => $user->updatedAt(),
            'deletedAt' => $user->deletedAt(),
            'name' => $user->name()->value(),
            'email' => $user->email()->value()
        ];
    }

    /**
     * @param array $data
     * @return User
     * @throws Exception
     */
    public function reverseTransform(array $data): User
    {
        $createdAt = new \DateTime($data['createdAt'], 'Y-m-d');
        $updatedAt = new \DateTime($data['updatedAt'], 'Y-m-d');
        $deletedAt = new \DateTime($data['deletedAt'], 'Y-m-d');

        return User::instantiate(
            Id::fromString($data['id']),
            $createdAt,
            $updatedAt,
            $deletedAt,
            Name::fromString($data['totalTime']),
            Email::fromString($data['points'])
        );
    }
}
