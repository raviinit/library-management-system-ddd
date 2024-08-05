<?php

namespace App\Shared;

abstract class Entity
{
    protected $id;

    public function getId()
    {
        return $this->id;
    }

}
