<?php

namespace App\Library\Borrow;

use App\Library\Borrow\Borrow;

interface BorrowRepositoryInterface
{
    public function findAll();
    public function findById($id);
    public function save(Borrow $borrow);
    public function update(Borrow $borrow, $id);
    public function remove($id);
}
