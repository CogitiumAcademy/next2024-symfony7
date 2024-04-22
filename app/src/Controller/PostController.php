<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    #[Route('/post/add', name: 'post_add')]
    public function addPost(Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        return $this->render('post/add.html.twig', [
            'form' => $form->createView(),
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
