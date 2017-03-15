<?php

namespace AppBundle\Controller\api;


use AppBundle\Entity\Task;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @FOSRest\Route(path="/api/tasks")
 */
class TaskController extends FOSRestController
{

    /**
     * @FOSRest\Get("/")
     * @FOSRest\View()
     *
     * @ApiDoc(
     *  section="Tasks",
     *  description="Returns a collection of Tasks"
     * )
     *
     */
    public function cgetTasksAction()
    {
        $tm = $this->container->get('app.taskmanager');

        return $tm->getAll();
    }

    /**
     * @FOSRest\Get("/{id}")
     * @FOSRest\View()
     *
     * @ApiDoc(
     *  section="Tasks",
     *  description="Get a Task",
     *  output="AppBundle\Entity\Task"
     * )
     *
     */
    public function getTaskAction($id)
    {
        $taskRepository = $this->getDoctrine()->getManager()->getRepository(Task::class);
        $task = $taskRepository->findOneById($id);
        if (null === $task) {
            throw  $this->createNotFoundException('Task does not exists');
        }
        return $task;
    }







}
