<?php

namespace App\App\Services;

use App\Library\Borrow\Borrow;
use App\Library\Borrow\BorrowRepositoryInterface;
use App\Library\Book\BookRepositoryInterface;
use App\Library\User\UserRepositoryInterface;

class BorrowService
{
    private $borrowRepository;
    private $bookRepository;
    private $userRepository;

    public function __construct(BorrowRepositoryInterface $borrowRepository, BookRepositoryInterface $bookRepository, UserRepositoryInterface $userRepository)
    {
        $this->borrowRepository = $borrowRepository;
        $this->bookRepository = $bookRepository;
        $this->userRepository = $userRepository;
    }

    public function getAllBorrows()
    {
        return $this->borrowRepository->findAll();
    }

    public function getBorrowById($id)
    {
        return $this->borrowRepository->findById($id);
    }

    /**
     * Borrow a book
     * createBorrow($data)
     * 
     * @param type $data
     * @return type
     */
    public function createBorrow($data)
    {
        $bookStatus = $this->bookRepository->findStatusById($data['book_id']);
        if (!$bookStatus) {
            echo json_encode(['status' => 'Book not available']);
            exit();
        }
        $this->bookRepository->updateStatusById($data['book_id'], !$bookStatus);
        $borrow = new Borrow($data['user_id'], $data['book_id']);
        return $this->borrowRepository->save($borrow);
    }
    
    /**
     * Return a book
     * updateBorrow($data, $id)
     * 
     * @param type $data
     * @param type $id - borrow id
     * @return type
     */
    public function updateBorrow($data, $id)
    {
        $bookStatus = $this->bookRepository->findStatusById($data['book_id']);
        if ($bookStatus) {
            echo json_encode(['status' => 'Book still available']);
            exit();
        }
        $this->bookRepository->updateStatusById($data['book_id'], !$bookStatus);
        $borrow = new Borrow($data['book_id']);
        return $this->borrowRepository->update($borrow, $id);
    }

    public function removeBorrow($id)
    {
        return $this->borrowRepository->remove($id);
    }

}
