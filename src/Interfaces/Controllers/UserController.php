<?php

namespace App\Interfaces\Controllers;

use App\App\Services\UserService;

class UserController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function list()
    {
        try {
            $users = $this->userService->getAllUsers();
            echo json_encode($users);
        } catch (\Exception $e) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function view($id)
    {
        try {
            $user = $this->userService->getUserById($id);
            echo json_encode($user);
        } catch (\Exception $e) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function create($data)
    {
        try {
            if (empty($data) || !isset($data)) {
                echo json_encode(['status' => 'Invalid or empty user information']);
                exit();
            }

            $this->userService->createUser($data);
            echo json_encode(['status' => 'User created successfully']);
        } catch (\Exception $e) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }
    
    public function update($data, $id)
    {
        try {
            $this->userService->updateUser($data, $id);
            echo json_encode(['status' => 'User updated successfully']);
        } catch (\Exception $e) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function updatePassword($data, $id)
    {
        try {
            $this->userService->updatePassword($data, $id);
            echo json_encode(['status' => 'User password updated successfully']);
        } catch (\Exception $e) {
            //echo ('Error occured: ' . $e);
            header("HTTP/1.1 500 Internal Server Error");
        }
    }
    
    public function remove($id)
    {
        try {
            $this->userService->removeUser($id);
            echo json_encode(['status' => 'User removed successfully']);
        } catch (\Exception $e) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }
    
    
}
