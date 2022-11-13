<?php

namespace Documents\Infrastructure\Domain;

use Documents\Domain\DocumentSlugCreatorStrategy;

class SimpleDocumentSlugCreatorStrategy implements DocumentSlugCreatorStrategy
{
    public function create(string $string): string
    {
        return preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    }
}