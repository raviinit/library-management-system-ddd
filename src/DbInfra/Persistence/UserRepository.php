<?php

namespace App\DbInfra\Persistence;

use App\Library\User\User;
use App\Library\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM users');
        return $stmt->fetchAll();
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function save(User $user)
    {
        $stmt = $this->pdo->prepare('INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$user->getName(), $user->getEmail(), $user->getPassword(), $user->getRole()]);
    }
    
    public function update(User $user, $id) {
        $stmt = $this->pdo->prepare('UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?');
        return $stmt->execute([$user->getName(), $user->getEmail(), $user->getRole(), $id]);
    }

    public function updatePassword($data, $id) {        
        $stmt = $this->pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
        return $stmt->execute([$data['password'], $id]);
    }
    
    public function remove($id) {
        $stmt = $this->pdo->prepare('DELETE FROM `users` WHERE `id` = ?');
        return $stmt->execute([$id]);
    }

}
