<?php

namespace App\App\Services;

use App\Library\Book\Book;
use App\Library\Book\BookRepositoryInterface;

class BookService
{
    private $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getAllBooks()
    {
        return $this->bookRepository->findAll();
    }

    public function getBookById($id)
    {
        return $this->bookRepository->findById($id);
    }

    public function isBookAvailable(Book $book) {
        return ($book->getStatus() == 'Available');
    }
    
    public function createBook($data)
    {
        $book = new Book($data['title'], $data['author'], $data['genre'], $data['isbn']);
        return $this->bookRepository->save($book);
    }
    
    public function updateBook($data, $id)
    {
        $book = new Book($data['title'], $data['author'], $data['genre'], $data['isbn'], $data['status']);
        return $this->bookRepository->update($book, $id);
    }

    public function removeBook($id)
    {
        return $this->bookRepository->remove($id);
    }

}
