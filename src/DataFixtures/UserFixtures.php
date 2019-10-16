<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0;$i<5; $i++)
        {
            $loUser = new User();
            $loUser->setUsername('test_'.$i.'@mail.com');
            $loUser->setPassword('test_'.$i);
            $loUser->setRoles(['USER']);
            $manager->persist($loUser);
            $manager->flush();
            var_dump($loUser);
        }
        // $product = new Product();clear
        // $manager->persist($product);


    }
}
