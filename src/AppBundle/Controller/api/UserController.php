<?php

namespace AppBundle\Controller\api;


use AppBundle\Entity\User;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @FOSRest\Route(path="/api/users")
 */
class UserController extends FOSRestController
{

    /**
     * @FOSRest\Get("/")
     * @FOSRest\View()
     *
     * @ApiDoc(
     *  section="Users",
     *  description="Returns a collection of Users"
     * )
     *
     */
    public function cgetUsersAction()
    {
        $userManager = $this->container->get('fos_user.user_manager');

        return $userManager->findUsers();
    }

    /**
     * @FOSRest\Get("/{id}")
     * @FOSRest\View()
     *
     * @ApiDoc(
     *  section="Users",
     *  description="Get a User",
     *  output="AppBundle\Entity\User"
     * )
     *
     */
    public function getUserAction(User $user)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        return $userManager->findUserBy(array('id'=>$user->getId()));
    }


}
