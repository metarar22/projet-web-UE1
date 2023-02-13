<?php

namespace App\Entity\AbstractEntity;

Abstract class AbstractProduct {
    protected int $productId;
    protected string $productName;
    protected string $productCategory;
    protected int $productPrice;
    protected int $productStock;
    protected string $productPicture;




    /**
     * Get the value of productId
     */ 
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set the value of productId
     *
     * @return  self
     */ 
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get the value of productName
     */ 
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set the value of productName
     *
     * @return  self
     */ 
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get the value of productCategory
     */ 
    public function getProductCategory()
    {
        return $this->productCategory;
    }

    /**
     * Set the value of productCategory
     *
     * @return  self
     */ 
    public function setProductCategory($productCategory)
    {
        $this->productCategory = $productCategory;

        return $this;
    }

    /**
     * Get the value of productPrice
     */ 
    public function getProductPrice()
    {
        return $this->productPrice;
    }

    /**
     * Set the value of productPrice
     *
     * @return  self
     */ 
    public function setProductPrice($productPrice)
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    /**
     * Get the value of productStock
     */ 
    public function getProductStock()
    {
        return $this->productStock;
    }

    /**
     * Set the value of productStock
     *
     * @return  self
     */ 
    public function setProductStock($productStock)
    {
        $this->productStock = $productStock;

        return $this;
    }

    /**
     * Get the value of productPicture
     */ 
    public function getProductPicture()
    {
        return $this->productPicture;
    }

    /**
     * Set the value of productPicture
     *
     * @return  self
     */ 
    public function setProductPicture($productPicture)
    {
        $this->productPicture = $productPicture;

        return $this;
    }
}