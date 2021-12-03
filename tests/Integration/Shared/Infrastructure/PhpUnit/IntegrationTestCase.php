<?php

declare(strict_types=1);

namespace DevSesame\Tests\Integration\Shared\Infrastructure\PhpUnit;

use DevSesame\Tests\Integration\Shared\Infrastructure\DataFixtures\MysqlFixtureLoader;
use Doctrine\DBAL\Exception;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class IntegrationTestCase extends KernelTestCase
{
    private MysqlFixtureLoader $mysqlFixtureLoader;
    /**
     * @return void
     */
    protected function setUp(): void
    {
        self::bootKernel(['environment' => 'test']);
        $this->mysqlFixtureLoader = $this->service(MysqlFixtureLoader::class);
        parent::setUp();
    }

    /**
     * @param string $className
     * @return object
     */
    protected function service($className)
    {
        return self::$container->get($className);
    }

    /**
     * @return void
     */
    protected function loadFixtures(): void
    {
        $this->mysqlFixtureLoader->loadFixtures();
    }

    /**
     * @return void
     * @throws Exception
     */
    protected function purge(): void
    {
        $this->mysqlFixtureLoader->purge();
    }
}
