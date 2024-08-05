<?php

namespace App\DbInfra\Persistence;

use App\Library\Book\Book;
use App\Library\Book\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    private $pdo;
    
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function findAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM books');
        return $stmt->fetchAll();
    }
    
    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM books WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function findStatusById($id)
    {
        $stmt = $this->pdo->prepare('SELECT status FROM books WHERE id = ?');
        $stmt->execute([$id]);
        return ($stmt->fetch()['status'] == 'Available');
    }

    public function updateStatusById($id, $status)
    {
        $sts = ($status) ? 'Available' : 'Borrowed';
        $stmt = $this->pdo->prepare("UPDATE books SET status = ? WHERE id = ?");
        return $stmt->execute([$sts, $id]);
    }
    
    public function save(Book $book)
    {
        $stmt = $this->pdo->prepare('INSERT INTO books (title, author, genre, isbn) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$book->getTitle(), $book->getAuthor(), $book->getGenre(), $book->getIsbn()]);
    }
    
    public function update(Book $book, $id) {
        $stmt = $this->pdo->prepare('UPDATE books SET title = ?, author = ?, genre = ?, isbn = ?, status = ? WHERE id = ?');
        return $stmt->execute([$book->getTitle(), $book->getAuthor(), $book->getGenre(), $book->getIsbn(), $book->getStatus(), $id]);
    }
    
    public function remove($id) {
        $stmt = $this->pdo->prepare('DELETE FROM `books` WHERE `id` = ?');
        return $stmt->execute([$id]);
    }
}
