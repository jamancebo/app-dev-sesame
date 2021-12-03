<?php

declare(strict_types=1);

namespace DevSesame\Tests\Integration\Signings\Infrastructure\DataFixtures;

use DevSesame\Signings\Domain\Repository\UserRepository;
use DevSesame\Tests\Mother\Signings\Domain\Entity\UserMother;
use DevSesame\Tests\Mother\Signings\Domain\ValueObject\EmailMother;
use DevSesame\Tests\Mother\Signings\Domain\ValueObject\IdMother;
use DevSesame\Tests\Mother\Signings\Domain\ValueObject\NameMother;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixture implements FixtureInterface
{
    public const ID = '023b5652-c1c0-33ad-8cde-84f6aeae84e1';
    /**
     * @var UserRepository
     */
    private UserRepository $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('es_ES');
        $id = IdMother::create(self::ID);
        $createdAt = $faker->datetime();
        $updatedAt = $faker->datetime();
        $deletedAt = $faker->datetime();
        $name = NameMother::random();
        $email = EmailMother::random();

        $user = UserMother::create(
            $id,
            $createdAt,
            $updatedAt,
            $deletedAt,
            $name,
            $email
        );

        $this->repository->create($user);
    }
}
