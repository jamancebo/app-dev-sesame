<?php

declare(strict_types=1);

namespace DevSesame\Signings\Infrastructure\EntryPoint\Controller\WorkEntry;

use DevSesame\Shared\Infrastructure\EntryPoint\Controller\JwtAuthorizedController;
use DevSesame\Shared\Infrastructure\EntryPoint\EntryPointToJsonResponse;
use DevSesame\Signings\Application\Command\FindWorkEntry;
use DevSesame\Signings\Application\DataTransformer\WorkEntryToArray;
use Exception;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetWorkEntry extends JwtAuthorizedController
{
    public function __invoke(
        string $id,
        Request $request,
        CommandBus $commandBus,
        EntryPointToJsonResponse $responseFormat,
        WorkEntryToArray $dataTransformer
    ): JsonResponse {

        if (!$this->isAuthorised('admin', $request)) {
            return $responseFormat->unauthorizedError();
        }

        $postWorkEntry = new FindWorkEntry($id);

        try {
            $workEntry = $commandBus->handle($postWorkEntry);
        } catch (Exception $e) {
            return $responseFormat->response(["data" => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        return $responseFormat->response([$dataTransformer->transform($workEntry)], Response::HTTP_CREATED);
    }
}
