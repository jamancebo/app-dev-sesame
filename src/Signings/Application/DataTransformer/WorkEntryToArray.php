<?php

declare(strict_types=1);

namespace DevSesame\Signings\Application\DataTransformer;

use DateTime;
use DevSesame\Signings\Domain\Entity\WorkEntry;
use Exception;

class WorkEntryToArray
{
    /**
     * @param WorkEntry $workEntry
     * @return array
     */
    public function transform(WorkEntry $workEntry): array
    {
        return [
            'id' => $workEntry->id()->value(),
            'userId' => $workEntry->userId()->value(),
            'createdAt' => $workEntry->createdAt(),
            'updatedAt' => $workEntry->updatedAt(),
            'deletedAt' => $workEntry->deletedAt(),
            'startDate' => $workEntry->startDate(),
            'endDate' => $workEntry->endDate()
        ];
    }

    /**
     * @param array $data
     * @return WorkEntry
     * @throws Exception
     */
    public function reverseTransform(array $data): WorkEntry
    {
        return WorkEntry::instantiate(
            Id::fromString($data['id']),
            Id::fromString($data['userId']),
            new DateTime($data['createdAt'], 'd/m/Y H:i:s'),
            new DateTime($data['updatedAt'], 'd/m/Y H:i:s'),
            new DateTime($data['deletedAt'], 'd/m/Y H:i:s'),
            new DateTime($data['deletedAt'], 'd/m/Y H:i:s'),
            new DateTime($data['deletedAt'], 'd/m/Y H:i:s')
        );
    }
}
