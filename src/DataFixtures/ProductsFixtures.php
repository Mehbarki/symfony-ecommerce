<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Products;

class ProductsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $product = new Products();

         $product->setDescription('description 1');
         $product->setName('name 1');
         $product->setPrice(10);
         $product->setStock(1);

         $manager->persist($product);

        $product2 = new Products();

        $product2->setDescription('description 2');
        $product2->setName('name 2');
        $product2->setPrice(20);
        $product2->setStock(2);

        $manager->persist($product2);

        $manager->flush();
    }
}
