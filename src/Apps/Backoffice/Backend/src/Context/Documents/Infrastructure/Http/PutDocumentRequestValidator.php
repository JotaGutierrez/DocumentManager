<?php

namespace Documents\Infrastructure\Http;

use Documents\Domain\Exception\PostDocumentInvalidRequest;
use Documents\Domain\DocumentRequestValidator;
use Symfony\Component\HttpFoundation\Request;

class PutDocumentRequestValidator implements DocumentRequestValidator
{
    public function validate(Request $request): array
    {
        $ob = $this->contentDecode($request);

        if ($this->isValid($ob)) {
            return $ob;
        }

        $ob = $this->requestDecode($request);

        if ($this->isValid($ob)) {
            return $ob;
        }

        throw new PostDocumentInvalidRequest();
    }

    private function contentDecode(Request $request): array
    {
        return json_decode($request->getContent(), true);
    }

    private function requestDecode(Request $request): array
    {
        return [
            'slug' => $request->request->get('slug', ''),
            'title' => $request->request->get('title', ''),
            'content' => $request->request->get('content', '')
        ];
    }

    private function isValid(array $arr) : bool
    {
        return $arr['slug'] !== '' and $arr['title'] !== '' and $arr['content'] !== '';
    }
}