<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Task;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTaskData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tasksData = [
            [
                'name' => 'modif page accueil',
                'description' => 'Modifier la page d\'accueil en ajoutant des choses importantes',
                'status' => Task::STATUS_OPEN,
                'category' => $this->getReference('category-1'),
            ],
            [
                'name' => 'modif page accueil 2',
                'description' => 'Modifier la page d\'accueil en ajoutant des choses peu importantes',
                'status' => Task::STATUS_OPEN,
                'category' => $this->getReference('category-0'),
            ],
            [
                'name' => 'modif page profil',
                'description' => 'Modifier la page profil en ajoutant des choses importantes',
                'status' => Task::STATUS_OPEN,
                'category' => $this->getReference('category-1'),
            ],
            [
                'name' => 'modif trucs',
                'description' => 'Modifier quelques trucs',
                'status' => Task::STATUS_OPEN,
                'category' => $this->getReference('category-1'),
            ],
            [
                'name' => 'modifier ce que tu sais',
                'description' => 'C\'est fini ça ?!?',
                'status' => Task::STATUS_CLOSED,
                'category' => $this->getReference('category-3'),
            ],
        ];

        foreach ($tasksData as $i => $taskData) {
            $task = new Task();
            $task->setName($taskData['name']);
            $task->setDescription($taskData['description']);
            $task->setStatus($taskData['status']);
            $task->setCategory($taskData['category']);
            $manager->persist($task);

            $this->addReference('task-'.$i, $task);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 20;
    }
}
