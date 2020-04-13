<?php


namespace App\Service;


use App\Entity\Product;

interface ProductTitleParserInterface
{
    public function parse(Product $product);

    public function supports(): array;
}