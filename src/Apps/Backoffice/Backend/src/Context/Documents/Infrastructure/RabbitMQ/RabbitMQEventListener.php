<?php

namespace Documents\Infrastructure\RabbitMQ;

use Documents\Domain\Event\DocumentCreated;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
class RabbitMQEventListener
{
    private LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function __invoke(DocumentCreated $event): void
    {
        $this->logger->info(sprintf('Document received: %s', $event->getDocument()->getSlug()));

        try {
            /** @TODO: Parametrize this */
            $client = new Client();

            $response = $client->post('http://elasticsearch:9200/documents/_doc', [
                'auth' => ['elastic', '1234'],
                'json' => $event->getDocument()->toArray()
            ]);

            if ($response->getStatusCode() === 201) {
                $this->logger->info(sprintf('document created: %s', $event->getDocument()->getSlug()));
            } else {
                $this->logger->warning(sprintf('unexpected response code on creation: %s', $response->getStatusCode()));
            }
        } catch (\Exception $e) {
            $this->logger->error(
                sprintf('Document error: %s (%s)', $e->getMessage(), $event->getDocument()->getSlug())
            );
        }
    }
}