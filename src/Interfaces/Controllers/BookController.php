<?php

namespace App\Interfaces\Controllers;

use App\App\Services\BookService;

class BookController
{
    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function list()
    {
        try {
            $books = $this->bookService->getAllBooks();
            echo json_encode($books);
        } catch (\Exception $e) {
            //echo ('Error occurred: ' . $e);
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function view($id)
    {
        try {
            $book = $this->bookService->getBookById($id);
            echo json_encode($book);
        } catch (\Exception $e) {
            //echo ('Error occurred: ' . $e);
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function create($data)
    {
        try {
            if (empty($data) || !isset($data)) {
                echo json_encode(['status' => 'Invalid or empty book information']);
                exit();
            }

            $this->bookService->createBook($data);
            echo json_encode(['status' => 'Book created successfully']);
        } catch (\Exception $e) {
            //echo ('Error occurred: ' . $e);
            header("HTTP/1.1 500 Internal Server Error");
        }
    }
    
    public function update($data, $id)
    {
        try {            
            $this->bookService->updateBook($data, $id);
            echo json_encode(['status' => 'Book updated successfully']);
        } catch (\Exception $e) {
            //echo ('Error occurred: ' . $e);
            header("HTTP/1.1 500 Internal Server Error");
        }
    }
    
    public function remove($id)
    {
        try {
            $this->bookService->removeBook($id);
            echo json_encode(['status' => 'Book removed successfully']);
        } catch (\Exception $e) {
            //echo ('Error occurred: ' . $e);
            header("HTTP/1.1 500 Internal Server Error");
        }
    }
}
