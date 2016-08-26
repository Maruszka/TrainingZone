<?php

namespace TrainingZoneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use TrainingZoneBundle\Entity\Training;
use TrainingZoneBundle\Form\TrainingType;

/**
 * @Route("/tr")
 *  
 */
class TrainingController extends Controller {

    private function addForm(Training $training) {

        $form = $this->createForm(new TrainingType(), $training, array(
            'action' => $this->generateUrl('trainingzone_training_add'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Dodaj'));

        return $form;
    }

    private function editForm() {
        $form = $this->createForm(new TrainingType(), $training, array(
            'action' => $this->generateUrl('trainingzone_training_edit'),
            'method' => 'POST',
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

        $training = new Training();
        $form = $this->addForm($training);
        return array("form" => $form->createView());
    }

    /**
     * @Route("/add")
     * @Method({"POST"})
     * @Template("TrainingZoneBundle:Training:show.html.twig")
     */
    public function addPostAction(Request $req) {
        $training = new Training();
        $form = $this->addForm($training);
        $form->handleRequest($req);
        $id = $training->getId();
        $categories = $training->getCategories();

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($training);
            $em->flush();

            return ['id' => $id, "training" => $training, "categories" => $categories];
        }
//        
//        return array(
//            'training' => $training,
//            'form'   => $form->createView(),
//        );
    }

    /**
     * @Route("/delete/{id}")
     * @Template()
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $this->getDoctrine()->getRepository("TrainingZoneBundle:Training");
        $trainingToDel = $repo->find($id);
        $em->remove($trainingToDel);
        $em->flush();

        $resp = $this->redirectToRoute("trainingzone_training_list");
        return $resp;
    }

    /**
     * @Route("/edit/{id}")
     * @Method({"GET"})
     * @Template()
     */
    public function editAction($id) {
        $repo = $this->getDoctrine()->getRepository("TrainingZoneBundle:Training");
        $training = $repo->find($id);
        return array("category" => $training);

        $editForm = $this->editForm($training);

        return array(
            'training' => $training,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * @Route("/edit/{id}")
     * @Method({"PUT"})
     */
    public function editPutAction(Request $req, $id) {
        $repo = $this->getDoctrine()->getRepository("TrainingZoneBundle:Training");
        $training = $repo->find($id);
        $em = $this->getDoctrine()->getManager();

        if (!$training) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->editForm($training);
        $editForm->handleRequest($req);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('trainingzone_training_edit', array('id' => $id)));
        }

        return array(
            'training' => $training,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * @Route("/show/{id}")
     * @Template()
     */
    public function showAction($id) {
        $repo = $this->getDoctrine()->getRepository("TrainingZoneBundle:Training"); //
        $training = $repo->find($id);
        $categories = $training->getCategories();
        if ($training === null) {
            return $this->redirectToRoute("trainingzone_training_list");
        }
        return $this->render("TrainingZoneBundle:Training:show.html.twig", ["training" => $training, 'categories' => $categories]);
    }

    /**
     * @Route("/list")
     * @Template()
     */
    public function listAction() {
        $repo = $this->getDoctrine()->getRepository("TrainingZoneBundle:Training");
        $allTrainings = $repo->findAll();
        if ($allTrainings === null) {
            return new Response("There are no traininigs to show");
        }
        return array("list" => $allTrainings);
    }

    /**
     * @Route("/byCategory")
     * @Template()
     */
    public function byCategoryAction() {
        $repo = $this->getDoctrine()->getRepository("TrainingZoneBundle:Training");
        $repo2 = $this->getDoctrine()->getRepository("TrainingZoneBundle:Category");
        $allCategories = $repo2->findAll();

        foreach ($allCategories as $key => $category) {
            $catId = $category->getId();
            $allByCat[] = $repo->getTrainingByCategory($catId);
        }


        if ($allByCat == null) {
            return new Response("There are no traininigs to show");
        }
        
        return array("allByCat" => $allByCat, "allCategories" => $allCategories);
    }


    /**
     * @Route("/byDate")
     * @Template()
     */
    public function byDateAction() {
        return array(
                // ...
        );
    }

    /**
     * @Route("/betweenDate")
     * @Template()
     */
    public function betweenDateAction() {
        return array(
                // ...
        );
    }

}
