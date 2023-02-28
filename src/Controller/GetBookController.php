<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Book;

class GetBookController extends AbstractController
{
    #[Route('/books', name: 'app_book_list')]
    
    public function list(EntityManagerInterface $entityManager)
    {
        // Obtengo todos los libros de la base de datos
        $allBooks = $entityManager->getRepository(Book::class)->findAll();

        // Obtengo los libros publicados antes de 2013
        $oldBooks = $entityManager->getRepository(Book::class)->findBy([
            'year' => '< 2013'
        ]);

        //TODO: obtener los libros de la categoría DRAMA, la información de un libro concreto, pasando como parámetro un ISBN, y que devolverá también las imágenes del libro, o al menos, el número de imágenes asociadas al libro.
        

        // Devuelvo los datos en formato JSON
        return new JsonResponse([
            'allBooks' => $bookData,
            'old_books' => $oldBookData,
        ]);
    }
}
