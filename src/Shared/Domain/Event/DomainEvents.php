<?php

declare(strict_types=1);

namespace DevSesame\Shared\Domain\Event;

use ArrayIterator;
use IteratorAggregate;

class DomainEvents implements IteratorAggregate
{
    /**
     * @var array|DomainEvent[]
     */
    private $events = [];

    /**
     * @param array $events
     */
    public function __construct(array $events)
    {
        $this->events = $events;
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->events);
    }
}
