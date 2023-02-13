<?php

namespace App\Entity;
use App\Entity\AbstractEntity\AbstractProduct;

class Fruit extends AbstractProduct{
    public function __construct(){
        $this->productCategory = 'Fruit';
        $this->productStock = '200';
    }
} 