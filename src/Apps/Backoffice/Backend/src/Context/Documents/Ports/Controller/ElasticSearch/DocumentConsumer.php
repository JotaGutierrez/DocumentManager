<?php

namespace Documents\Ports\Controller\ElasticSearch;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/elastic/document', name: 'elastic_document_create', methods: ['POST'])]
class DocumentConsumer
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(Request $request) : Response
    {
        $this->logger->info('Message received: ' . json_encode($request->request));

        return new Response();
    }
}
