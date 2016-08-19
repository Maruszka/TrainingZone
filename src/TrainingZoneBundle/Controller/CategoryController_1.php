<?php

namespace TrainingZoneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TrainingZoneBundle\Entity\Category;

/**
 * @Route("/cat")

 */
class CategoryController extends Controller {

    //formularz do kategorii
    private function createCategoryForm(Category $category) {
        $form = $this->createForm(new CategoryType(), $entity, array(
            'action' => $this->generateUrl('trainingzone_category_add'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Add'));

        return $form;
    }

    //formularz do kategorii
    private function editCategoryForm(Category $category) {
        $form = $this->createForm(new CategoryType(), $category, array(
            'action' => $this->generateUrl('trainingzone_category_edit', array('id' => $category->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Edytuj'));

        return $form;
    }

    /**
     * @Route("/add")
     * @Template()
     * @Method({"GET"})
     */
    public function addAction() {
        return [];
    }

    /**
     * @Route("/add")
     * @Method({"POST"})
     */
    public function addPostAction(Request $req) {
        $newCategory = new Category;
        //pobieram dane zformularza
        $form = $this->createCategoryForm($newCategory);
        $form->handleRequest($request);
        if ($form->isValid()) {
            //zapisuje do bazy danych
            $em = $this->getDoctrine()->getManager();
            $em->persist($newCategory);
            $em->flush();

            return $this->redirectToRoute("trainingzone_category_show", ["id" => $newCategory->getId()]);
        }
        return array(
            'category' => $newCategory,
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/edit/{id}")
     * @Method({"GET"})
     * @Template()
     */
    public function editAction($id) {
        $repo = $this->getDoctrine()->getRepository("TrainingZoneBundle:Category");
        $category = $repo->find($id);
        $form = $this->editCategoryForm($category);
        
        return["form"=>$form->createView()];   
    }

    /**
     * @Route("/edit/{id}")
     * @Method("PUT")
     */
    public function editPostAction(Request $req, $id) {
        $repo = $this->getDoctrine()->getRepository("TrainingZoneBundle:Category");
        $category = $repo->find($id);
        $em = $this->getDoctrine()->getManager();

        $newName = $req->request->get("name");
        $category->setName($newName);
        $em->flush();

        $resp = $this->redirectToRoute("trainingzone_category_show", ["id" => $category->getId()]);
        return $resp;
    }

    /**
     * @Route("/delete/{id}")
     * @Template()
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $this->getDoctrine()->getRepository("TrainingZoneBundle:Category");
        $catToDel = $repo->find($id);
        $em->remove($catToDel);
        $em->flush();

        $resp = $this->redirectToRoute("trainingzone_category_list");
        return $resp;
    }

    /**
     * @Route("/show/{id}")
     * @Template()
     */
    public function showAction($id) {
        $repo = $this->getDoctrine()->getRepository("TrainingZoneBundle:Category"); //
        $category = $repo->find($id);
        if ($category === null) {
            return $this->redirectToRoute("trainingzone_category_list");
        }
        return $this->render("TrainingZoneBundle:Category:show.html.twig", ["category" => $category]);
    }

    /**
     * @Route("/list")
     * @Template()
     */
    public function listAction() {
        $repo = $this->getDoctrine()->getRepository("TrainingZoneBundle:Category");
        $allCategories = $repo->findAll();
        if ($allCategories === null) {
            return new Response("There are no categories to show");
        }
        return array("allCategories" => $allCategories);
    }

}
