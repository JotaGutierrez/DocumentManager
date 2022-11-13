<?php

namespace Documents\Domain;

interface DocumentSlugCreator
{
    public function __construct(DocumentSlugCreatorStrategy $slugCreatorStrategy);

    public function create(string $string) : string;
}