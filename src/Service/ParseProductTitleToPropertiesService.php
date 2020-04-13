<?php


namespace App\Service;


use App\Entity\Product;

class ParseProductTitleToPropertiesService
{
    private $parsers;

    public function __construct(iterable $parsers)
    {
        $this->parsers = $parsers;
    }

    public function parse(Product $product)
    {
        $productCategoryCode = $product->getCategory()->getCode();

        /** @var ProductTitleParserInterface $parser */
        foreach ($this->parsers as $parser) {
            if (!in_array($productCategoryCode, $parser->supports())) continue;
            $parser->parse($product);
        }
    }
}