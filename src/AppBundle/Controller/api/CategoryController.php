<?php

namespace AppBundle\Controller\api;


use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



/**
 * @FOSRest\Route(path="/api/categories")
 */
class CategoryController extends FOSRestController
{

    /**
     * @FOSRest\Get("/")
     * @FOSRest\View()
     *
     * @ApiDoc(
     *  section="Categories",
     *  description="Returns a collection of Categories"
     * )
     *
     */
    public function cgetCategoriesAction()
    {
        $cm = $this->container->get('app.categorymanager');

        return $cm->getAll();
    }

    /**
     * @FOSRest\Get("/{id}")
     * @FOSRest\View()
     *
     * @ApiDoc(
     *  section="Categories",
     *  description="Get a Category",
     *  output="AppBundle\Entity\Category"
     * )
     *
     */
    public function getCategoryAction($id)
    {
        $categoryRepository = $this->getDoctrine()->getManager()->getRepository(Category::class);
        $category = $categoryRepository->findOneById($id);
        if (null === $category) {
            throw  $this->createNotFoundException('Category does not exists');
        }
        return $category;
    }


    /**
     * @FOSRest\Post("/")
     * @FOSRest\View(statusCode=201)
     *
     * @ApiDoc(
     *  section="Categories",
     *  description="Create a new Category",
     *  input="AppBundle\Form\CategoryType",
     *  output="AppBundle\Entity\Category"
     * )
     *
     * @param Request $request
     *
     * @return Form|Category
     */
    public function postAction(Request $request)
    {
        $cm = $this->container->get('app.categorymanager');

        $form = $this->get('form.factory')->createNamed('', CategoryType::class, $cm->create(), [
            'csrf_protection' => false,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cm->save($form->getData());
            return $form->getData();
        }

        return new View($form->getErrors(), Response::HTTP_BAD_REQUEST);
    }


}
