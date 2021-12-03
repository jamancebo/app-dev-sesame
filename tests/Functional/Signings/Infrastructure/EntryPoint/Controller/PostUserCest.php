<?php

declare(strict_types=1);

namespace DevSesame\Tests\Functional\Signings\Infrastructure\EntryPoint\Controller;

use Codeception\Util\HttpCode;
use DevSesame\Tests\Functional\Shared\Infrastructure\Codeception\FunctionalCestCase;
use FunctionalTester;

class PostUserCest extends FunctionalCestCase
{
    private const TOKEN = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyb2wiOiJhZG1pbiIsImV4cCI6MTgwNjMwNjUyMH0.T0EnxMFv95p-n-HTUEmRDlHAJD7YUzXqZpc9YDP2824';

    public function _before(FunctionalTester $I)
    {
        parent::setUp($I);
        $this->purge();
        $this->loadFixtures();
    }

    public function _after(FunctionalTester $I)
    {
        $this->purge();
    }

    public function testErrorWhenUnauthorizedRole(FunctionalTester $I)
    {
        // phpcs:ignore Generic.Files.LineLength -- JWT cannot be shortened
        $jwtRoleGuest = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyb2wiOiJndWVzdCIsImV4cCI6MTgwNjMwNjUyMH0.teAzg9HalGvJnGPcNWYGY7vTWZtbcmoCePJEEUwAPHY';
        $I->haveHttpHeader('Authorization', 'Bearer ' . $jwtRoleGuest);
        $I->sendPost('v1/user', '');
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    /**
     * @param FunctionalTester $I
     */
    public function testErrorOnEmptyRequestBody(FunctionalTester $I)
    {
        $user = [
            [
                "id" => "e775b66c-5096-11ec-bf63-0242ac130002",
                "deletedAt" => null,
                "name" => "Eduardo",
                "email" => "edu@ori.com"
            ]
        ];
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Authorization', 'Bearer ' . self::TOKEN);
        $I->sendPost('v1/user', $user);
        $I->seeResponseCodeIs(HttpCode::UNPROCESSABLE_ENTITY);
    }

    /**
     * @param FunctionalTester $I
     */
    public function testPost(FunctionalTester $I)
    {
        $user = [
            "id" => "e775b66c-5096-11ec-bf63-0242ac130112",
            "createdAt" => "28/11/2023 00:00:00",
            "updatedAt" => "29/12/2021 00:00:00",
            "deletedAt" => null,
            "name" => "Eduardo",
            "email" => "edu@ori.com"
        ];

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Authorization', 'Bearer ' . self::TOKEN);
        $I->sendPOST('/v1/user', $user);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIs(HttpCode::CREATED);
    }
}
