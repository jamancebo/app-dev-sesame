<?php

declare(strict_types=1);

namespace DevSesame\Signings\Infrastructure\EntryPoint\Controller\User;

use DevSesame\Shared\Infrastructure\EntryPoint\Controller\JwtAuthorizedController;
use DevSesame\Shared\Infrastructure\EntryPoint\EntryPointToJsonResponse;
use DevSesame\Signings\Application\Command\FindUser;
use DevSesame\Signings\Application\DataTransformer\UserToArray;
use Exception;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetUser extends JwtAuthorizedController
{
    /**
     * @param string $id
     * @param Request $request
     * @param CommandBus $commandBus
     * @param EntryPointToJsonResponse $responseFormat
     * @param UserToArray $dataTransformer
     * @return JsonResponse
     */
    public function __invoke(
        string $id,
        Request $request,
        CommandBus $commandBus,
        EntryPointToJsonResponse $responseFormat,
        UserToArray $dataTransformer
    ): JsonResponse {

        if (!$this->isAuthorised('admin', $request)) {
            return $responseFormat->unauthorizedError();
        }

        $user = new FindUser($id);
        try {
            $userFound = $commandBus->handle($user);
        } catch (Exception $e) {
            return $responseFormat->response(["data" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return $responseFormat->response(["data" => $dataTransformer->transform($userFound)], Response::HTTP_CREATED);
    }
}
