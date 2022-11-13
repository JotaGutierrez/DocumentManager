<?php

namespace App\Context\Documents\Ports\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'home', methods: ['GET'])]
class TestController
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(['msg' => 'OK'], Response::HTTP_OK);
    }
}