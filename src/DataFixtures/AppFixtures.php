<?php

namespace App\DataFixtures;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Task;
use App\Entity\Cat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $users = [];
        // $product = new Product();
        // $manager->persist($product);
        for($i=0; $i<100; $i++){
            $user = new User();
            //génération d'un utilisateur factice
            $user->setNameUser($faker->lastName());
            $user->setFirstNameUser($faker->firstname());
            $user->setLoginUser($faker->email());
            $user->setMdpUser($faker->password());
            //stockage dans le manager
            $manager->persist($user);
            $users[] = $user;
        }
        $cat = new Cat();
        //Boucle qui va itérer 100 articles factices
        for($i=0; $i<50; $i++){
            $cat = new Cat();
            //génération d'un utilisateur factice
            $cat->setNameCat($faker->lastName());
            //stockage dans le manager
            $manager->persist($cat);
            $cats[] = $cat;
        }
        $task = new Task();
        for($i=0; $i<500; $i++){
            $task = new Task();
            //génération d'un utilisateur factice
            $task->setNameTask($faker->lastName());
            $task->setContentTask($faker->text(200));
            $task->setDateTask(new \DateTimeImmutable());
            $task->setIdUser($users[$faker->numberBetween(0,49)]);
            $task->setIdCat($cats[$faker->numberBetween(0,9)]);
            //stockage dans le manager
            $manager->persist($task);
            $tasks[] = $task;
        }
        $manager->flush();
    }
}
