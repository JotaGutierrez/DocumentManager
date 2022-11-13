<?php

namespace Context\Documents\Ports\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Messenger\Transport\InMemoryTransport;

class PostDocumentTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient();

        $client->request('POST', '/document', [
            'title' => 'Document title',
            'content' => 'Document content'
        ]);

        $this->assertSame(201, $client->getResponse()->getStatusCode());

        /* @var InMemoryTransport $transport */
        $transport = $this->getContainer()->get('messenger.transport.async');
        $this->assertCount(1, $transport->getSent());
    }
}
