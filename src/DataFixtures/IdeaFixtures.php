<?php

namespace App\DataFixtures;

use App\Entity\Idea;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class IdeaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
//        for($i = 0;$i <30; $i++)
//        {
//           $c = rand(1,5);
//           $user = $manager->getRepository(User::class)->find($c);
//           var_dump($c);
//           $loFaker = \Faker\Factory::create();
//           $loIdea = new Idea();
//           $loIdea->setClient();
//           $loIdea->setDateCreation(new \DateTime('now'));
//           $loIdea->setIdea($loFaker->text(25));
//           $manager->persist($loIdea);
//            $manager->flush();
//        }
        // $product = new Product();
        // $manager->persist($product);


    }
}
