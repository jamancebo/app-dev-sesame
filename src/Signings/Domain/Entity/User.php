<?php

declare(strict_types=1);

namespace DevSesame\Signings\Domain\Entity;

use DateTime;
use DevSesame\Shared\Domain\Aggregate\AggregateRoot;
use DevSesame\Signings\Domain\ValueObject\Email;
use DevSesame\Signings\Domain\ValueObject\Id;
use DevSesame\Signings\Domain\ValueObject\Name;

class User extends AggregateRoot
{
    private Id $id;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private ?DateTime $deletedAt;
    private Name $name;
    private Email $email;

    /**
     * User constructor.
     * @param Id $id
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     * @param DateTime|null $deletedAt
     * @param Name $name
     * @param Email $email
     */
    public function __construct(
        Id $id,
        DateTime $createdAt,
        DateTime $updatedAt,
        ?DateTime $deletedAt,
        Name $name,
        Email $email
    ) {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @param Id|null $id
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     * @param DateTime|null $deletedAt
     * @param Name $name
     * @param Email $email
     * @return static
     */
    public static function instantiate(
        ?Id $id,
        DateTime $createdAt,
        DateTime $updatedAt,
        ?DateTime $deletedAt,
        Name $name,
        Email $email
    ): self {
        return new User($id, $createdAt, $updatedAt, $deletedAt, $name, $email);
    }

    /**
     * @param Id $id
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     * @param DateTime|null $deletedAt
     * @param Name $name
     * @param Email $email
     */
    public function update(
        DateTime $createdAt,
        DateTime $updatedAt,
        ?DateTime $deletedAt,
        Name $name,
        Email $email
    ) {
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return Id
     */
    public function id(): Id
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function createdAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function updatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @return DateTime|null
     */
    public function deletedAt(): ?DateTime
    {
        return $this->deletedAt ?? null;
    }

    /**
     * @return Name
     */
    public function name(): Name
    {
        return $this->name;
    }

    /**
     * @return Email
     */
    public function email(): Email
    {
        return $this->email;
    }
}
