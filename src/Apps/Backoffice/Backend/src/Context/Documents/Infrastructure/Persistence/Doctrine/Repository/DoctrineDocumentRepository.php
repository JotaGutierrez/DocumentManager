<?php

namespace Documents\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Documents\Domain\Document;
use Documents\Domain\DocumentRepository;
use Documents\Domain\Event\DocumentCreated;
use Symfony\Component\Messenger\MessageBusInterface;

class DoctrineDocumentRepository implements DocumentRepository
{
    private MessageBusInterface $messageBus;
    private EntityManagerInterface $em;

    public function __construct(
        EntityManagerInterface $em,
        MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
        $this->em = $em;
    }

    public function save(Document $document): void
    {
        $this->em->persist($document);

        $this->em->flush();

        $this->messageBus->dispatch(new DocumentCreated($document));
    }

    public function fetchAll(): array
    {
        return $this->em->getRepository(Document::class)->findAll();
    }

    public function fetchBySlug(string $slug): ?Document
    {
        return $this->em->getRepository(Document::class)->findOneBy(['slug' => $slug]);   
    }
}