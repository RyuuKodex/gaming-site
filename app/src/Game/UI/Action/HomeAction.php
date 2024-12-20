<?php

declare(strict_types=1);

namespace App\Game\UI\Action;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomeAction extends AbstractController
{
    #[Route('/home', name: 'app.home', methods: ['GET'])]
    public function __invoke(): Response
    {
        return $this->render('home.html.twig');
    }
}
