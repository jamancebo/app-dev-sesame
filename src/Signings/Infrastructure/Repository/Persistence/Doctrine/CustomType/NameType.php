<?php

declare(strict_types=1);

namespace DevSesame\Signings\Infrastructure\Repository\Persistence\Doctrine\CustomType;

use DevSesame\Shared\Infrastructure\Repository\Doctrine\CustomType\StringCustomType;
use DevSesame\Signings\Domain\ValueObject\Name;

class NameType extends StringCustomType
{

    protected function typeClassName(): string
    {
        return Name::class;
    }
}
