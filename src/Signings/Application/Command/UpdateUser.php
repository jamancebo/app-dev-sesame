<?php

declare(strict_types=1);

namespace DevSesame\Signings\Application\Command;

use DateTime;

class UpdateUser
{
    private string $id;
    private string $createdAt;
    private string $updatedAt;
    private ?string $deletedAt;
    private string $name;
    private string $email;


    /**
     * User constructor.
     * @param string $id
     * @param string $createdAt
     * @param string $updatedAt
     * @param string|null $deletedAt
     * @param string $name
     * @param string $email
     */
    public function __construct(
        string $id,
        string $createdAt,
        string $updatedAt,
        ?string $deletedAt,
        string $name,
        string $email
    ) {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
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
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }
}
