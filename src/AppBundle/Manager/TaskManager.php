<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;

class TaskManager
{
    private $em;

    /**
     * TaskManager constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return Task
     */
    public function create()
    {
        return new Task();
    }

    /**
     * @param Task $task
     */
    public function save(Task $task)
    {
        if (null === $task->getId()) {
            $this->em->persist($task);
        }
        $this->em->flush();
    }
}
