<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    #[Route('/post/{id}', name: 'post_view')]
    public function post_view(): Response
    {
        return $this->render('post/post_view.html.twig', [
            'post' => [
                'title' => 'Le titre 2',
                'content' => 'Le super contenu'
            ],
        ]);
    }
}
