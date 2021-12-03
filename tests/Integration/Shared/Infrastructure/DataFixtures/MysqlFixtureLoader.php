<?php

declare(strict_types=1);

namespace DevSesame\Tests\Integration\Shared\Infrastructure\DataFixtures;

use DevSesame\Signings\Domain\Repository\UserRepository;
use DevSesame\Signings\Domain\Repository\WorkEntryRepository;
use DevSesame\Tests\Integration\Shared\Domain\DataFixtures\FixtureLoader;
use DevSesame\Tests\Integration\Signings\Infrastructure\DataFixtures\UserFixture;
use DevSesame\Tests\Integration\Signings\Infrastructure\DataFixtures\WorkEntryFixture;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;

class MysqlFixtureLoader implements FixtureLoader
{
    private EntityManager $entityManager;
    private Loader $loader;
    private UserRepository $userRepository;
    private WorkEntryRepository $workEntryRepository;
    private ORMPurger $purger;

    /**
     * @var ORMExecutor
     */
    private ORMExecutor $executor;

    /**
     * @param EntityManager $entityManager
     * @param UserRepository $userRepository
     * @param WorkEntryRepository $workEntryRepository
     */
    public function __construct(
        EntityManager $entityManager,
        UserRepository $userRepository,
        WorkEntryRepository $workEntryRepository
    ) {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
        $this->workEntryRepository = $workEntryRepository;
        $this->loader = new Loader();
        $this->loader->addFixture(new UserFixture($this->userRepository));
        $this->loader->addFixture(new WorkEntryFixture($this->workEntryRepository));
        $this->purger = new ORMPurger();
        $this->executor = new ORMExecutor($this->entityManager, $this->purger);
    }

    /**
     * @return void
     */
    public function loadFixtures(): void
    {
        $this->executor->execute($this->loader->getFixtures(), true);
    }

    /**
     * @throws Exception
     */
    public function purge(): void
    {
        $this->entityManager->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS=0');
        $this->executor->purge();
        $this->entityManager->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS=1');
        $this->entityManager->getConnection()->close();
    }

    /**
     * @return void
     */
    private function addCustomFixtures(): void
    {
        $this->loader->addFixture(
            new UserFixture(
                $this->userRepository
            )
        );

        $this->loader->addFixture(
            new WorkEntryFixture(
                $this->workEntryRepository
            )
        );
    }
}
