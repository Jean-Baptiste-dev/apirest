<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{

    public function __construct(private PostRepository $postRepository, private EntityManagerInterface $em)
    {
    }
    #[Route('/post', name: 'app.post', methods: ['GET'])]
    public function index(): Response
    {
        $posts =  $this->postRepository->findAll();
        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/post/create', name: 'app.post.create', methods: ['POST'])]
    public function create(Request $request)
    {
        $post = new Post;
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($post);
            $this->em->flush();

            return $this->render('post/index.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }

    #[Route('/post/edit/{id}', name: 'app.post.edit', methods: ['PUT', 'PATCH'])]
    public function edit(Request $request, Post $post)
    {

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //$this->em->persist($post);
            $this->em->flush();
            return $this->render('post/index.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }

    #[Route('/post/delete/{id}', name: 'app.post.delete')]
    public function delete(Post $post)
    {
        $this->em->remove($post);
        $this->em->flush();
        $this->redirectToRoute('app.post');
    }
}
