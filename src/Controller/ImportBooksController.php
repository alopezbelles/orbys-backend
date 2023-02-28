<?php

namespace App\Controller;

// use src\Entity\book;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

// Creo un controlador con un método "import" para manejar la importación 
// del archivo JSON ubicado en la carpeta 'assets'.

class ImportBooksController extends AbstractController
{
    
    public function import(SerializerInterface $serializer): JsonResponse
    {

        
        // Obtengo la ruta del archivo JSON utilizando el servicio $this->getParameter('kernel.project_dir') que me proporciona la ruta del directorio raíz del proyecto. Luego, construyo la ruta completa al archivo JSON.

        $filePath = $this->getParameter('kernel.project_dir') . './public/assets/books.json';

        // Verifico si existe el archivo. Si no existe lanzo un error. 
        if (!file_exists($filePath)) {
            return new JsonResponse(['message' => 'El archivo no existe.'], Response::HTTP_BAD_REQUEST);
        }

        // Si existe, leo el contenido del archivo.
        $jsonContent = file_get_contents($filePath);

        // Deserializo el JSON a un arreglo de PHP.
        $data = $serializer->decode($jsonContent, JsonEncoder::FORMAT);

        // Almaceno los datos en la base de datos. Recorro el array de datos y para cada item, creo una nueva instancia de la
        // entidad 'Book', le asigno los datos correspondientes y lo almaceno en la base de datos usando el método 'persist()', y
        // guardo los cambios con 'flush()'.

        foreach ($data as $item) {
            $book = new Book();
            $book->setIsbn($item['isbn']);
            $book->setTitle($item['title']);
            $book->setSubtitle($item['subtitle']);
            $book->setAuthor($item['author']);
            $book->setPublished($item['published']);
            $book->setPublisher($item['publisher']);
            $book->setPages($item['pages']);
            $book->setDescription($item['description']);
            $book->setWebsite($item['website']);
            $book->setCategory($item['category']);
            $entityManager->persist($book);
        }
        $entityManager->flush();

        return new JsonResponse(['message' => 'Los datos han sido importados exitosamente.'], Response::HTTP_OK);
    }
}
