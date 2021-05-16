<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AjoutTag extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i =0; $i < 20; $i++) {
            $t = new \App\Entity\Tag();
            $t->setTagName('tag'.$i);

            $manager->persist($t);}

        $manager->flush();
    }
}
