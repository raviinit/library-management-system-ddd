<?php

namespace App\Library\Book;

use App\Library\Book\Book;

interface BookRepositoryInterface
{
    public function findAll();
    public function findById($id);
    public function findStatusById($id);
    public function updateStatusById($id, $status);
    public function save(Book $book);
    public function update(Book $book, $id);
    public function remove($id);
}
