<?php

declare(strict_types=1);

namespace DevSesame\Signings\Domain\Entity;

use DateTime;
use DevSesame\Shared\Domain\Aggregate\AggregateRoot;
use DevSesame\Signings\Domain\ValueObject\Id;

class WorkEntry extends AggregateRoot
{
    private Id $id;
    private Id $userId;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private ?DateTime $deletedAt;
    private DateTime $startDate;
    private ?DateTime $endDate;

    /**
     * WorkEntry constructor.
     * @param Id $id
     * @param Id $userId
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     * @param DateTime|null $deletedAt
     * @param DateTime $startDate
     * @param ?DateTime $endDate
     */
    public function __construct(
        Id $id,
        Id $userId,
        DateTime $createdAt,
        DateTime $updatedAt,
        ?DateTime $deletedAt,
        DateTime $startDate,
        ?DateTime $endDate
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @param Id $id
     * @param Id $userId
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     * @param DateTime|null $deletedAt
     * @param DateTime $startDate
     * @param ?DateTime $endDate
     * @return static
     */
    public static function instantiate(
        Id $id,
        Id $userId,
        DateTime $createdAt,
        DateTime $updatedAt,
        ?DateTime $deletedAt,
        DateTime $startDate,
        ?DateTime $endDate
    ): self {
        return new WorkEntry($id, $userId, $createdAt, $updatedAt, $deletedAt, $startDate, $endDate);
    }

    /**
     * @param Id $userId
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     * @param DateTime|null $deletedAt
     * @param DateTime $startDate
     * @param DateTime|null $endDate
     */
    public function update(
        Id $userId,
        DateTime $createdAt,
        DateTime $updatedAt,
        ?DateTime $deletedAt,
        DateTime $startDate,
        ?DateTime $endDate
    ): void {
        $this->userId = $userId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return Id
     */
    public function id(): Id
    {
        return $this->id;
    }

    /**
     * @return Id
     */
    public function userId(): Id
    {
        return $this->userId;
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
     * @return DateTime
     */
    public function startDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * @return DateTime|null
     */
    public function endDate(): ?DateTime
    {
        return $this->endDate;
    }
}
