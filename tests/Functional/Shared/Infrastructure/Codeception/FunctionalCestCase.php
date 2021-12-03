<?php

declare(strict_types=1);

namespace DevSesame\Tests\Functional\Shared\Infrastructure\Codeception;

use DevSesame\Tests\Integration\Shared\Infrastructure\DataFixtures\MysqlFixtureLoader;
use FunctionalTester;

abstract class FunctionalCestCase
{
    private MysqlFixtureLoader $mysqlFixtureLoader;

    protected function setUp(FunctionalTester $I): void
    {
        $this->mysqlFixtureLoader = $I->grabService(MysqlFixtureLoader::class);
    }

    protected function loadFixtures()
    {
        $this->mysqlFixtureLoader->loadFixtures();
    }

    protected function purge()
    {
        $this->mysqlFixtureLoader->purge();
    }
}
