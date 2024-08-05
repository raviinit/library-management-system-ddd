<?php

namespace App\App\Services;

use App\Library\User\User;
use App\Library\User\UserRepositoryInterface;

class UserService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->findAll();
    }

    public function getUserById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function createUser($data)
    {
        $user = new User($data['name'], $data['email'], $data['password'], $data['role']);
        return $this->userRepository->save($user);
    }
    
    public function updateUser($data, $id)
    {
        $user = new User($data['name'], $data['email'], $data['role']);
        return $this->userRepository->update($user, $id);
    }
    
    public function updatePassword($data, $id) {
        return $this->userRepository->updatePassword($data, $id);
    }

    public function removeUser($id)
    {
        return $this->userRepository->remove($id);
    }

}
