<?php

declare(strict_types=1);

namespace App\UI\Controller;

use App\Infrastructure\HttpClient\IGDBClient;
use App\Infrastructure\HttpClient\TwitchClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class HelloWorldAction extends AbstractController
{
    public function __construct(private readonly IGDBClient $IGDBClient)
    {
    }

    #[Route('/api/hello-world', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $this->IGDBClient->getGames();

        return $this->json(['message' => 'Hello, world']);
    }
}
