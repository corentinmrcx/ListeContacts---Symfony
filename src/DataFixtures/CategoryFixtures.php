<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $path = __DIR__ . '/data/Category.json';
        $json = file_get_contents($path);
        $categories = json_decode($json, true);

        foreach ($categories as $category) {
            CategoryFactory::createOne($category);
        }

        $manager->flush();
    }
}
