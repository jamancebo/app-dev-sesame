<?php

declare(strict_types=1);

namespace DevSesame\Signings\Infrastructure\Repository\Persistence\Doctrine\CustomType;

use DevSesame\Shared\Infrastructure\Repository\Doctrine\CustomType\StringCustomType;
use DevSesame\Signings\Domain\ValueObject\Id;

class IdType extends StringCustomType
{
    /**
     * @inheritDoc
     */
    protected function typeClassName(): string
    {
        return Id::class;
    }
}
