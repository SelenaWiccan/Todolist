<?php

namespace App\DataFixtures;

use App\Entity\Todo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i <20; $i++){
            $todo = new Todo(); //generer 50 ' php bin/console doctrine:fixtures:load '
            $rand = random_int(0,100);
            $todo->setName('todo'.$rand);

        $manager->persist($todo);
        $manager->flush(50);
        }

        //tri
        //filtres + MDR
        //PAGINATION

    }
}
