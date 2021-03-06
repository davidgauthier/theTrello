<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends Controller
{
    /**
     * @Route("/", name="app_homepage", methods={"GET"})
     */
    public function indexAction(Request $request)
    {
        $cm = $this->container->get('app.categorymanager');

        return $this->render(':front:index.html.twig', [
                'listCategories' => $cm->getAll(),
                //'listCategories' => array(),
            ]
        );
    }
}
