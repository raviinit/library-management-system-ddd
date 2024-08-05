<?php

namespace App\Library\User;

use App\Library\User\User;

interface UserRepositoryInterface
{
    public function findAll();
    public function findById($id);
    public function save(User $user);
    public function update(User $user, $id);
    public function updatePassword($pwd, $id);
    public function remove($id);

}
