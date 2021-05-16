<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;



class AddPublicite extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i =0; $i < 20; $i++) {
            $p = new \App\Entity\Publicite();
            $p->setLibelle('pub'.$i);
            $p->setImage('');

            $p->setStartDate(new \DateTime());
            $p->setEndDate(new \DateTime());
            $p->setDescription('description'.$i);
            $p->setCodePromo('code'.$i);

            $p->setCategory($this->getReference('category.abstract'));




            $manager->persist($p);}

        $manager->flush();
    }
}
