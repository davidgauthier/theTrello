<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class CategoryManager
{
    private $em;

    /**
     * CategoryManager constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return Category
     */
    public function create()
    {
        return new Category();
    }


    /**
     * @param Category $category
     */
    public function save(Category $category)
    {
        if(null === $category->getId()) {
            $this->em->persist($category);
        }
        $this->em->flush();
    }



    public function getAll()
    {
        $categoryRepository = $this->em->getRepository(Category::class);
        //$categoryRepository = $this->em->getRepository('AppBundle:Category');

        return $categoryRepository->findAll();
    }
}
