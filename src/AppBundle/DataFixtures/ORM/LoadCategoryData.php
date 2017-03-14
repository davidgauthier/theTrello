<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = [
            'A faire',
            'En cours',
            'Terminee',
            'Bugs/Retours',
        ];

        foreach ($names as $i => $name) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);

            $this->addReference('category-'.$i, $category);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
}
