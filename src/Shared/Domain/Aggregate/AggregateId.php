<?php

declare(strict_types=1);

namespace DevSesame\Shared\Domain\Aggregate;

interface AggregateId
{
    /**
     * @return mixed
     */
    public function value();
}

