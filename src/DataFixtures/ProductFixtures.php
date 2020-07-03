<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
class ProductFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        //Instanciation de Faker
        $faker = Factory::create('fr_FR');
        
      //generer 50 produits
        for($i=0;$i<50;$i++){
            $product=new Product();
            $product
                 ->setName($faker->sentence(3))
                ->setDescription($faker->optional()->realText())
                ->setPrice($faker->numberBetween(1000,35000))
                ->setCreatedAt($faker->dateTimeBetween('-6 month'))
                ;


            //Recuperation aléatoire d'une catégorie par une réference (on la fait apres avoir creer le category fixtures
            $categoryReference ='category_' .$faker->numberBetween(0,2);
            $category =$this->getReference($categoryReference);
            /** @var Category $category *///il est pas obligatoir (03/07/2020 10h20)7min
            //$category c'est un objet de la class category

            $product->setCategory($category);


            $manager->persist($product);
        }
        $manager->flush();
    }
    /**
     * Liste des classes de fixtures qui doivent etre chargées avant celle-ci

     */
    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [
            CategoryFixtures::class
        ];
    }
}

