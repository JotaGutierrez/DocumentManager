<?php

namespace Documents\Domain;

use Symfony\Component\HttpFoundation\Request;

interface DocumentRequestValidator
{
    public function validate(Request $request): array;
}
