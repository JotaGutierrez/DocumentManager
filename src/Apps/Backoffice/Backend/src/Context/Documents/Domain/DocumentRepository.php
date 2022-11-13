<?php

namespace Documents\Domain;

interface DocumentRepository
{
    public function save(Document $document): void;

    public function fetchAll(): array;

    public function fetchBySlug(string $slug): ?Document;
}
