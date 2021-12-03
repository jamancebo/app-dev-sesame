<?php

declare(strict_types=1);

namespace DevSesame\Signings\Infrastructure\EntryPoint\Controller\WorkEntry;

use DevSesame\Shared\Infrastructure\EntryPoint\Controller\JwtAuthorizedController;
use DevSesame\Shared\Infrastructure\EntryPoint\EntryPointToJsonResponse;
use DevSesame\Signings\Application\Command\FindUserWorkEntry;
use DevSesame\Signings\Application\DataTransformer\WorkEntryToArray;
use Exception;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetUserWorkEntry extends JwtAuthorizedController
{
    public function __invoke(
        string $userId,
        Request $request,
        CommandBus $commandBus,
        EntryPointToJsonResponse $responseFormat,
        WorkEntryToArray $dataTransformer
    ): JsonResponse {

        if (!$this->isAuthorised('admin', $request)) {
            return $responseFormat->unauthorizedError();
        }

        $result = [];

        $postWorkEntry = new FindUserWorkEntry($userId);

        try {
            $arrayWorkEntry = $commandBus->handle($postWorkEntry);
        } catch (Exception $e) {
            return $responseFormat->response(["data" => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        foreach ($arrayWorkEntry as $workEntry) {
            $result[] =  $dataTransformer->transform($workEntry);
        }

        return $responseFormat->response($result, Response::HTTP_CREATED);
    }
}
