<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FillDemoData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tyresCategory = new ProductCategory();
        $tyresCategory
            ->setTitle('Шины')
            ->setCode('tyres')
        ;
        $manager->persist($tyresCategory);

        $productsArray = [
            'Toyo H08 195/75R16C 107/105S TL Летние',
            'Pirelli Winter SnowControl serie 3 175/70R14 84T TL Зимние (нешипованные)',
            'BFGoodrich Mud-Terrain T/A KM2 235/85R16 120/116Q TL Внедорожные',
            'Pirelli Scorpion Ice & Snow 265/45R21 104H TL Зимние (нешипованные)',
            'Pirelli Winter SottoZero Serie II 245/45R19 102V XL Run Flat * TL Зимние (нешипованные)',
            'Nokian Hakkapeliitta R2 SUV/Е 245/70R16 111R XL TL Зимние (нешипованные)',
            'Pirelli Winter Carving Edge 225/50R17 98T XL TL Зимние (шипованные)',
            'Continental ContiCrossContact LX Sport 255/55R18 105H FR MO TL Всесезонные',
            'BFGoodrich g-Force Stud 205/60R16 96Q XL TL Зимние (шипованные)',
            'BFGoodrich Winter Slalom KSI 225/60R17 99S TL Зимние (нешипованные)',
            'Continental ContiSportContact 5 245/45R18 96W SSR FR TL Летние',
            'Continental ContiWinterContact TS 830 P 205/60R16 92H SSR * TL Зимние (нешипованные)',
            'Continental ContiWinterContact TS 830 P 225/45R18 95V XL SSR FR * TL Зимние (нешипованные)',
            'Hankook Winter I*Cept Evo2 W320 255/35R19 96V XL TL/TT Зимние (нешипованные)',
            'Mitas Sport Force+ 120/65R17 56W TL Летние'
        ];
        foreach ($productsArray as $productTitle) {
            $product = new Product();
            $product->setTitle($productTitle);
            $product->setCategory($tyresCategory);
            $manager->persist($product);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
