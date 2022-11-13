<?php

namespace Documents\Domain\Exception;

class PostDocumentInvalidRequest extends \Exception
{
    protected $message = 'Invalid request params. Ensure title and content are sent';
}