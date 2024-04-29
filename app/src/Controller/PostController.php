<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();
        $oldposts = $postRepository->findOldPosts(2);
        //dd($oldposts);

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
            'oldPosts' => $oldposts,
        ]);
    }

    #[Route('/post/add', name: 'post_add')]
    public function addPost(Request $request, ManagerRegistry $doctrine): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setUser($this->getUser());            
            $post->setActive(false);
            $em = $doctrine->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('post/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    //#[Route('/post/{id}', name: 'post_view')]
    #[Route('/post/{slug}', name: 'post_view')]
    public function post_view(Post $post): Response
    {
        //dd($post);
        return $this->render('post/post_view.html.twig', [
            'post' => $post,
        ]);
    }
}
