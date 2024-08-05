<?php

namespace App\DbInfra\Persistence;

use App\Library\Borrow\Borrow;
use App\Library\User\User;
use App\Library\Borrow\BorrowRepositoryInterface;

class BorrowRepository implements BorrowRepositoryInterface
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM borrows');
        return $stmt->fetchAll();
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM borrows WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Borrow a book
     * 
     * @param Borrow $borrow
     * @return type
     */
    public function save(Borrow $borrow)
    {
        $stmt = $this->pdo->prepare('INSERT INTO borrows (user_id, book_id) VALUES (?, ?)');
        return $stmt->execute([$borrow->getUser(), $borrow->getBook()]);
    }
    
    /**
     * Return a book
     * update(Borrow $borrow, $id)
     * 
     * @param Borrow $borrow
     * @param type $id
     * @return type
     */
    public function update(Borrow $borrow, $id) {
        $stmt = $this->pdo->prepare('UPDATE borrows SET checkin_date = ? WHERE id = ?');
        return $stmt->execute([date('Y-m-d H:i:s'), $id]);
    }
    
    /**
     * Remove borrow record
     * 
     * @param type $id
     * @return type
     */
    public function remove($id) {
        $stmt = $this->pdo->prepare('DELETE FROM `borrows` WHERE `id` = ?');
        return $stmt->execute([$id]);
    }
}
