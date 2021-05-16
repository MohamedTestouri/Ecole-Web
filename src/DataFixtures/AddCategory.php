<?php

namespace App\DataFixtures;
use \app\entity\Tableformations;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AddCategory extends Fixture
{
    public function load(ObjectManager $manager)
    {   $c = new \App\Entity\CategoryPublicity();
        $c->setDescription('categorie1');
        $this->addReference('category.abstract',$c);

        $manager->persist($c);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
