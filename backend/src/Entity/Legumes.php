<?php

namespace App\Entity;
use App\Entity\AbstractEntity\AbstractProduct;

class Legume extends AbstractProduct{
    public function __construct(){
        $this->productCategory = 'Legume';
        $this->productStock = '200';
    }
} 