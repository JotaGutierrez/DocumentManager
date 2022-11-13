<?php

namespace Documents\Domain;

interface DocumentSlugCreatorStrategy
{
    public function create(string $string) : string;
}