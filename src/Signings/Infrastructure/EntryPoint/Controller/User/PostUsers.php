<?php

declare(strict_types=1);

namespace DevSesame\Signings\Infrastructure\EntryPoint\Controller\User;

use DevSesame\Shared\Infrastructure\EntryPoint\Controller\JwtAuthorizedController;
use DevSesame\Shared\Infrastructure\EntryPoint\EntryPointToJsonResponse;
use DevSesame\Signings\Application\Command\CreateUser;
use DevSesame\Signings\Application\DataTransformer\UserToArray;
use Exception;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostUsers extends JwtAuthorizedController
{
    public function __invoke(
        Request $request,
        CommandBus $commandBus,
        EntryPointToJsonResponse $responseFormat,
        UserToArray $dataTransformer
    ): JsonResponse {

        if (!$this->isAuthorised('admin', $request)) {
            return $responseFormat->unauthorizedError();
        }

        $param = json_decode($request->getContent(), true);

        if (!$this->paramsAreValid($param)) {
            return $responseFormat->error(
                'Valid data not provided in request body',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $postUser = new CreateUser(
            $param['id'],
            $param['createdAt'],
            $param['updatedAt'],
            $param['deletedAt'],
            $param['name'],
            $param['email']
        );

        try {
            $commandBus->handle($postUser);
        } catch (Exception $e) {
            return $responseFormat->response(["data" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return $responseFormat->response(["data" => "Created User OK"], Response::HTTP_CREATED);
    }

    /**
     * @param array|null $params
     * @return bool
     */
    private function paramsAreValid(?array $params): bool
    {
        if (!is_array($params)) {
            return false;
        }

        $requiredParams = [
            'id' => fn ($id) => is_string($id),
            'createdAt' => fn ($createdAt) => is_string($createdAt),
            'updatedAt' => fn ($updatedAt) => is_string($updatedAt),
            'name' => fn ($name) => is_string($name),
            'email' => fn ($email) => is_string($email)
        ];

        foreach ($requiredParams as $paramName => $isValidParam) {
            if (!array_key_exists($paramName, $params)) {
                return false;
            }

            if (!$isValidParam($params[$paramName])) {
                return false;
            }
        }

        return true;
    }
}
