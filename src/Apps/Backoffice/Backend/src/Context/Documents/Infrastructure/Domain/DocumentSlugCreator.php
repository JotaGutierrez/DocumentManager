<?php

namespace Documents\Infrastructure\Domain;

use Documents\Domain\DocumentSlugCreator as BaseDocumentSlugCreator;
use Documents\Domain\DocumentSlugCreatorStrategy;

class DocumentSlugCreator implements BaseDocumentSlugCreator
{
    private DocumentSlugCreatorStrategy $slugCreatorStrategy;

    public function __construct(DocumentSlugCreatorStrategy $slugCreatorStrategy)
    {
        $this->slugCreatorStrategy = $slugCreatorStrategy;
    }

    public function create(string $string): string
    {
        return $this->slugCreatorStrategy->create($string);
    }
}