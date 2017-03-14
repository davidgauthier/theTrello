<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\TaskEditType;
use AppBundle\Form\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller
{
    /**
     * @Route("/task/new/", name="app_task_new", methods={"GET", "POST"} )
     */
    public function newAction(Request $request)
    {
        $tm = $this->container->get('app.taskmanager');

        // On crée un objet Task
        $task = $tm->create();

        // On récup le form
        $formTask = $this->createForm(TaskType::class, $task);

        // On fait le lien Requête <-> Formulaire
        // À partir de maintenant, la variable $task contient les valeurs entrées dans le formulaire
        $formTask->handleRequest($request);

        // On vérifie que les valeurs entrées sont correctes
        if ($formTask->isSubmitted() && $formTask->isValid()) {
            // On enregistre notre objet $task dans la base de données
            $tm->save($task);

            // Pour notifier l'utilisateur
//            $request->getSession()->getFlashBag()->add('success', $this->get('translator')->trans('tweet.message.succes'));
            $request->getSession()->getFlashBag()->add('success', 'Task \''.$task->getName().'\' saved');

            // On redirige vers la page d'acceuil
            return $this->redirectToRoute('app_homepage', [
//                'id' => $tweet->getId(),
                ]
            );
        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render(':task:new.html.twig', [
                'formTask' => $formTask->createView(),
            ]
        );
    }

    /**
     * @Route("/task/edit/{idTask}", name="app_task_edit", methods={"GET", "POST"} )
     */
    public function editAction(Request $request, $idTask)
    {
        $tm = $this->container->get('app.taskmanager');

        // On récupère la task
        $taskRepository = $this->getDoctrine()->getManager()->getRepository(Task::class);
        $task = $taskRepository->findOneById($idTask);

        if (null === $task) {
            throw  $this->createNotFoundException('Task does not exists');
        }

        // On récup le form
        $formTask = $this->createForm(TaskEditType::class, $task);

        // On fait le lien Requête <-> Formulaire
        // À partir de maintenant, la variable $task contient les valeurs entrées dans le formulaire
        $formTask->handleRequest($request);

        // On vérifie que les valeurs entrées sont correctes
        if ($formTask->isSubmitted() && $formTask->isValid()) {
            // On enregistre notre objet $task dans la base de données
            $tm->save($task);

            // Pour notifier l'utilisateur
//            $request->getSession()->getFlashBag()->add('success', $this->get('translator')->trans('tweet.message.succes'));
            $request->getSession()->getFlashBag()->add('success', 'Task \''.$task->getName().'\' saved');

            // On redirige vers la page d'acceuil
            return $this->redirectToRoute('app_homepage', [
//                'id' => $tweet->getId(),
                ]
            );
        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render(':task:edit.html.twig', [
                'formTask' => $formTask->createView(),
            ]
        );
    }
}
