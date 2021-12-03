<?php

declare(strict_types=1);

namespace DevSesame\Tests\Integration\Signings\Infrastructure\PhpUnit;

use DevSesame\Signings\Domain\Repository\UserRepository;
use DevSesame\Signings\Domain\Repository\WorkEntryRepository;
use DevSesame\Tests\Integration\Shared\Infrastructure\PhpUnit\IntegrationTestCase;

class ModuleIntegrationTestCase extends IntegrationTestCase
{
    private UserRepository $userRepository;
    private WorkEntryRepository $workEntryRepository;
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->loadFixtures();
    }

    /**
     * @return void
     * @throws \Doctrine\DBAL\Exception
     */
    public function tearDown(): void
    {
        parent::tearDown();
        $this->purge();
    }

    /**
     * @return UserRepository
     */
    public function userRepository(): UserRepository
    {
        if (empty($this->userRepository)) {
            return $this->service(UserRepository::class);
        }
    }

    /**
     * @return WorkEntryRepository
     */
    public function workEntryRepository(): WorkEntryRepository
    {
        if (empty($this->workEntryRepository)) {
            return $this->service(WorkEntryRepository::class);
        }
    }
}
