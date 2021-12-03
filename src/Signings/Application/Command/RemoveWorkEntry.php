<?php

declare(strict_types=1);

namespace DevSesame\Signings\Application\Command;

class RemoveWorkEntry
{
    private string $id;

    /**
     * WorkEntry constructor.
     * @param string $id
     */
    public function __construct(
        string $id
    ) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }
}
