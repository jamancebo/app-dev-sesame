<?php

declare(strict_types=1);

namespace DevSesame\Signings\Domain\ValueObject;

use DevSesame\Shared\Domain\Aggregate\AggregateId;
use DevSesame\Shared\Domain\ValueObject\Uuid;

class Id extends Uuid implements AggregateId
{

}
