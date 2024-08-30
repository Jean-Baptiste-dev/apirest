<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class BookController extends AbstractController
{

    public function __construct(
        private BookRepository $bookrepo,
        private SerializerInterface $serializer
    ) {}

    #[Route('/api/books', name: 'book', methods: ['GET'])]
    public function getAllBooks(): JsonResponse
    {
        $books = $this->bookrepo->findAll();
        $jsonBookList = $this->serializer->serialize($books, 'json', ['groups' => 'getBooks']);
        return new JsonResponse($jsonBookList, Response::HTTP_OK, [], true);
    }

    #[Route('/api/books/{id}', name: 'detailBook', methods: ['GET'])]
    public function getDetailBook(Book $book): JsonResponse
    {
        $jsonBook = $this->serializer->serialize($book, 'json', ['groups' => 'getBooks']);
        return new JsonResponse($jsonBook, Response::HTTP_OK, [], true);
    }
}
