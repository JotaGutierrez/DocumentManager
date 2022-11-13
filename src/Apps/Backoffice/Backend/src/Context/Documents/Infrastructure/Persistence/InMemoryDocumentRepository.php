<?php

namespace Documents\Infrastructure\Persistence;

use Documents\Domain\Document;
use Documents\Domain\DocumentRepository;
use Documents\Domain\Event\DocumentCreated;
use Symfony\Component\Messenger\MessageBusInterface;

class InMemoryDocumentRepository implements DocumentRepository
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function save(Document $document): void
    {
        $this->messageBus->dispatch(new DocumentCreated($document));
    }

    public function fetchAll(): array
    {
        return [];
    }

    public function fetchBySlug(string $slug): ?Document
    {
        return null;
    }
}