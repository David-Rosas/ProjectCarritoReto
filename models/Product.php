<?php

namespace Models;

/**
 * Product
 */
class Product
{
    private $code;
    private $productName;
    private $price;
    private $rate;

    public function __construct()
    {
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode(int $code)
    {
        $this->code = $code;
    }

    private function getProductName() : string
    {
        return $this->productName;
    }

    public function setProductName(string $productName)
    {
        $this->productName = $productName;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function getRate()
    {
        return $this->rate;
    }

    public function setRate(int $rate)
    {
        $this->rate = $rate;
    }
}
