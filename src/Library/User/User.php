<?php

namespace App\Library\User;

use App\Shared\Entity;

class User extends Entity
{
    private $name;
    private $email;
    private $password;
    private $role;

    public function __construct($name='', $email='', $role='', $password='')
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }    
    
}
