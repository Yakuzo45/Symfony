<?php
/**
 * Created by PhpStorm.
 * User: wilder7
 * Date: 09/11/18
 * Time: 08:11
 */

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($a=0; $a < 5; $a++) {
            for ($i = 0; $i < 10; $i++) {
                $article = new Article();
                $article->setName($faker->name);
                $article->setCategory($this->getReference('categorie_'.$a));
                $manager->persist($article);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}