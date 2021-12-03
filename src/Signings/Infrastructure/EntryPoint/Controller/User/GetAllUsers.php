<?php

declare(strict_types=1);

namespace DevSesame\Signings\Infrastructure\EntryPoint\Controller\User;

use DevSesame\Shared\Infrastructure\EntryPoint\Controller\JwtAuthorizedController;
use DevSesame\Shared\Infrastructure\EntryPoint\EntryPointToJsonResponse;
use DevSesame\Signings\Application\Command\FindAllUsers;
use DevSesame\Signings\Application\DataTransformer\UserToArray;
use Exception;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetAllUsers extends JwtAuthorizedController
{
    /**
     * @param Request $request
     * @param CommandBus $commandBus
     * @param EntryPointToJsonResponse $responseFormat
     * @param UserToArray $dataTransformer
     * @return JsonResponse
     */
    public function __invoke(
        Request $request,
        CommandBus $commandBus,
        EntryPointToJsonResponse $responseFormat,
        UserToArray $dataTransformer
    ): JsonResponse {

        if (!$this->isAuthorised('admin', $request)) {
            return $responseFormat->unauthorizedError();
        }

        $result = [];
        $user = new FindAllUsers();
        try {
            $usersFound = $commandBus->handle($user);
        } catch (Exception $e) {
            return $responseFormat->response(["data" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        foreach ($usersFound as $userFound) {
            $result[] =  $dataTransformer->transform($userFound);
        }

        return $responseFormat->response($result, Response::HTTP_CREATED);
    }
}
