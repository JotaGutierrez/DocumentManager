<?php

namespace Documents\Application;

use Documents\Domain\Document;
use Documents\Domain\DocumentRepository;
use Documents\Domain\DocumentSlugCreator;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class DocumentCreate
{
    private DocumentRepository $repository;
    private DocumentSlugCreator $slugCreator;

    public function __construct(
        DocumentRepository $repository,
        DocumentSlugCreator $slugCreator
    ) {
        $this->repository = $repository;
        $this->slugCreator = $slugCreator;
    }

    public function __invoke(DocumentCreateCommand $command): Document
    {
        $slug = $this->slugCreator->create($command->getTitle());

        $document = new Document(
            $slug,
            $command->getTitle(),
            $command->getContent()
        );

        $this->repository->save($document);

        return $document;
    }
}