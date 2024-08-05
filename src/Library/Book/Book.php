<?php

namespace App\Library\Book;

use App\Shared\Entity;

class Book extends Entity
{
    private $title;
    private $author;
    private $genre;
    private $isbn;
    private $status;

    public function __construct($title = '', $author = '', $genre = '', $isbn = '', $status = '')
    {
        $this->title = $title;
        $this->author = $author;
        $this->genre = $genre;
        $this->isbn = $isbn;
        $this->status = $status;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthor()
    {
        return $this->author;
    }
    
    public function getGenre() {
        return $this->genre;
    }

    public function getIsbn()
    {
        return $this->isbn;
    }
    
    public function getStatus() {
        return $this->status;
    }
}
