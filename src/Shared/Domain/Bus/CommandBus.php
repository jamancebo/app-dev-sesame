<?php

declare(strict_types=1);

namespace DevSesame\Shared\Domain\Bus;

interface CommandBus
{
    /**
     * @param object $command
     */
    public function handle($command);
}
