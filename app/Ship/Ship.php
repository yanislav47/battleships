<?php

namespace App\Ship;

class Ship implements ShipInterface
{
    protected $size;
    protected $name;

    public function getSize()
    {
        return $this->size;
    }

    public function getName()
    {
        return $this->name;
    }
}