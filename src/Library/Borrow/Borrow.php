<?php

namespace App\Library\Borrow;

use App\Shared\Entity;
//use App\Library\Book\Book;
//use App\Library\User\User;

class Borrow extends Entity
{
    private $book;
    private $user;
    private $checkout_date;
    private $checkin_date;

    public function __construct($user = null, $book = null, $checkout_date = '', $checkin_date = '')
    {
        $this->user = $user;
        $this->book = $book;
        $this->checkout_date = $checkout_date;
        $this->checkin_date = $checkin_date;
    }

    public function getBook()
    {
        return $this->book;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getCheckoutDate()
    {
        return $this->checkout_date;
    }

    public function getCheckinDate()
    {
        return $this->checkin_date;
    }
    
    
}
