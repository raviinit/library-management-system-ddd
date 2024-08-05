<?php

namespace App\Interfaces\Controllers;

use App\App\Services\BorrowService;

class BorrowController
{
    private $borrowService;

    public function __construct(BorrowService $borrowService)
    {
        $this->borrowService = $borrowService;
    }

    /**
     * View all the borrowed records
     * list()
     * 
     */
    public function list()
    {
        try {
            $borrows = $this->borrowService->getAllBorrows();
            echo json_encode($borrows);
        } catch (\Exception $e) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    /**
     * View the borrowed record details
     * view($id)
     * 
     * @param type $id
     */
    public function view($id)
    {
        try {
            $borrow = $this->borrowService->getBorrowById($id);
            echo json_encode($borrow);
        } catch (\Exception $e) {
            header("HTTP/1.1 500 Internal Server Error");
        }        
    }

    /**
     * Borrow a book
     * create($data)
     * 
     * @param type $data
     */
    public function create($data)
    {
        try {
            $this->borrowService->createBorrow($data);
            echo json_encode(['status' => 'Borrow record created successfully']);
        } catch (\Exception $e) {
            echo 'Error occured: '. $e;
            header("HTTP/1.1 500 Internal Server Error");
        }
    }
    
    /**
     * Return a book
     * update($data, $id)
     * 
     * @param type $data
     * @param type $id
     */
    public function update($data, $id)
    {
        try {
            $this->borrowService->updateBorrow($data, $id);
            echo json_encode(['status' => 'Borrow record updated and book returned successfully']);
        } catch (\Exception $e) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }
    
    /**
     * Remove a borrow record
     * remove($id)
     * 
     * @param type $id
     */
    public function remove($id)
    {
        try {
            $this->borrowService->removeBorrow($id);
            echo json_encode(['status' => 'Borrow record removed successfully']);
        } catch (\Exception $e) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }
    
}
