<?php

namespace DevSesame\Signings\Application\Command;

class FindUserWorkEntry
{
    private string $userId;

    /**
     * WorkEntry constructor.
     * @param string $userId
     */
    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function userId(): string
    {
        return $this->userId;
    }
}
