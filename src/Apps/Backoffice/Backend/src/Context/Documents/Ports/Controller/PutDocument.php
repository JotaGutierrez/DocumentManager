<?php

namespace Documents\Ports\Controller;

use Documents\Application\DocumentUpdateCommand;
use Documents\Domain\Document;
use Documents\Domain\Exception\PostDocumentInvalidRequest;
use Documents\Domain\DocumentRequestValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/document', name: 'document_update', methods: ['PUT'])]
class PutDocument extends AbstractController
{
    use HandleTrait;

    private MessageBusInterface $messageBus;
    private DocumentRequestValidator $requestValidator;

    public function __construct(
        MessageBusInterface $messageBus,
        DocumentRequestValidator $requestValidator
    ) {
        $this->messageBus = $messageBus;
        $this->requestValidator = $requestValidator;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            /**
             * @TODO: Refactor. Split validation and DTO creation into two separate services and join them into a parser service
             * @TODO: Create DTO class
             *
             * $documentDTO = $this->>requestParser->parse($request);
             */
            $documentDTO = $this->requestValidator->validate($request);

            /** @var Document $document */
            $document = $this->handle(new DocumentUpdateCommand(
                $documentDTO['slug'],
                $documentDTO['title'],
                $documentDTO['content']
            ));
        } catch (PostDocumentInvalidRequest|\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(['document'=> $document->toArray()], Response::HTTP_OK);
    }
}