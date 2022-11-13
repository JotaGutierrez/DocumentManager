<?php

namespace Documents\Domain\Event;

use Documents\Domain\Document;
use Symfony\Contracts\EventDispatcher\Event;

class DocumentCreated extends Event
{
    public const NAME = 'document.updated';

    protected Document $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function getDocument(): Document
    {
        return $this->document;
    }
}
