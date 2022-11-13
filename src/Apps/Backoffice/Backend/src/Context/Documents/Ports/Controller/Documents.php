<?php

namespace Documents\Ports\Controller;

use Documents\Domain\DocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/documents', name: 'documents_fetch', methods: ['GET'])]
class Documents extends AbstractController
{
    private DocumentRepository $repository;

    public function __construct(
        DocumentRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $documents = array_map(fn($document) => $document->toArray(), $this->repository->fetchAll());

        return new JsonResponse($documents, Response::HTTP_OK);
    }
}
