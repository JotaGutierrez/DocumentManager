<?php

namespace Documents\Application;

use Documents\Domain\Document;
use Documents\Domain\DocumentRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class DocumentUpdate
{
    private DocumentRepository $repository;

    public function __construct(
        DocumentRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function __invoke(DocumentUpdateCommand $command): Document
    {
        /** @var Document $document */
        $document = $this->repository->fetchBySlug($command->getSlug());
        
        $document->setTitle($command->getTitle());
        $document->setContent($command->getContent());

        $this->repository->save($document);

        return $document;
    }
}