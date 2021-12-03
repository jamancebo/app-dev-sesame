<?php

declare(strict_types=1);

namespace DevSesame\Signings\Infrastructure\EntryPoint\Controller\WorkEntry;

use DevSesame\Shared\Infrastructure\EntryPoint\Controller\JwtAuthorizedController;
use DevSesame\Shared\Infrastructure\EntryPoint\EntryPointToJsonResponse;
use DevSesame\Signings\Application\Command\RemoveWorkEntry;
use DevSesame\Signings\Application\DataTransformer\WorkEntryToArray;
use Exception;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteWorkEntry extends JwtAuthorizedController
{
    public function __invoke(
        Request $request,
        CommandBus $commandBus,
        EntryPointToJsonResponse $responseFormat,
        WorkEntryToArray $dataTransformer
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

        $postWorkEntry = new RemoveWorkEntry($param['id']);

        try {
            $commandBus->handle($postWorkEntry);
        } catch (Exception $e) {
            return $responseFormat->response(["data" => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        return $responseFormat->response(["data" => "Created WorkEntry OK"], Response::HTTP_CREATED);
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
            'id' => fn ($id) => is_string($id)
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
