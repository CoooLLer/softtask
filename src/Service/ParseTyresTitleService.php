<?php


namespace App\Service;


use App\Entity\Product;

class ParseTyresTitleService implements ProductTitleParserInterface
{

    public function parse(Product $product)
    {
        //делаем четко по т.з. т.е. хардкодим, в реальности можно было бы собирать из типов свойств с подхватом возможных существующих значений
        $re = '/';
        $re .= '(?<brand>Nokian|BFGoodrich|Pirelli|Toyo|Continental|Hankook|Mitas)';
        $re .= '\s+?';
        $re .= '(?<model>.*?)';
        $re .= '\s+?';
        $re .= '(?<width>[0-9]{1,3})';
        $re .= '\/';
        $re .= '(?<height>[0-9]{1,3})';
        $re .= '\s*?';//было замечено отсутствие пробелов в этом месте в некоторых товарах, в этом месте можно нивелировать ошибку, точность определения не пострадает
        $re .= '(?<cordType>B|D|R)';//соответственно википедии по кодировке шин
        $re .= '(?<diameter>[0-9]{1,2})';
        $re .= '\s+?';
        $re .= '(?<loadIndex>[0-9]{2,3})';
        $re .= '(?<speedSymbol>[A-Z][0-9]|\([A-Z]\)|[A-Z])';
        $re .= '\s*?';
        $re .= '(?<designates>[A-Za-z0-9\s]*?)';
        $re .= '\s*?';
        $re .= '(?<runflatAbbreviation>RunFlat|Run Flat|ROF|ZP|SSR|ZPS|HRS|RFT){0,1}';
        $re .= '\s*?';
        $re .= '(?<tubeType>ТТ|TL|TL\/TT)';
        $re .= '\s+?';
        $re .= '(?<season>Зимние \(шипованные\)|Внедорожные|Летние|Зимние \(нешипованные\)|Всесезонные)';
        $re .= '/iu';

        $matches = [];
        if (preg_match($re, $product->getTitle(), $matches) === 1) {
            $product->setIsCorrectTitle(true);
            foreach ($matches as $k => $match) {
                if (!is_numeric($k)) {
                    $product->getProperties()->{'set' . ucfirst($k)}(trim($match));
                }
            }
        } else {
            $product->setIsCorrectTitle(false);
        }
    }

    public function supports(): array
    {
        return [
            'tyres'
        ];
    }
}