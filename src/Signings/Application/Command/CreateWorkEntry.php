<?php

declare(strict_types=1);

namespace DevSesame\Signings\Application\Command;

class CreateWorkEntry
{
    private string $userId;
    private string $createdAt;
    private string $updatedAt;
    private ?string $deletedAt;
    private string $startDate;
    private ?string $endDate;


    /**
     * WorkEntry constructor.
     * @param string $userId
     * @param string $createdAt
     * @param string $updatedAt
     * @param string|null $deletedAt
     * @param string $startDate
     * @param string|null $endDate
     */
    public function __construct(
        string $userId,
        string $createdAt,
        string $updatedAt,
        ?string $deletedAt,
        string $startDate,
        ?string $endDate
    ) {
        $this->userId = $userId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return string
     */
    public function userId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function createdAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function updatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @return string|null
     */
    public function deletedAt(): ?string
    {
        return $this->deletedAt;
    }

    /**
     * @return string
     */
    public function startDate(): string
    {
        return $this->startDate;
    }

    /**
     * @return string|null
     */
    public function endDate(): ?string
    {
        return $this->endDate ?? null;
    }
}
