<?php

namespace TrainingZoneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use TrainingZoneBundle\Entity\Training;
use TrainingZoneBundle\Form\TrainingType;

class TrainingController extends Controller {

    private function addForm() {
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
        $form = $this->addForm();
        return array("form" => $form->createView());
    }

    /**
     * @Route("/add")
     * @Method({"POST"})
     */
    public function addPostAction(Request $req) {
        $entity = new Training();
        $form = $this->addForm($entity);
        $form->handleRequest($req);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('trainingzone_training_show', array('id' => $entity->getId())));
        }
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
        if ($training === null) {
            return $this->redirectToRoute("trainingzone_training_list");
        }
        return $this->render("TrainingZoneBundle:Training:show.html.twig", ["training" => $training]);
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
        return array("allTrainings" => $allTrainings);
    
    }

    /**
     * @Route("/byName")
     * @Template()
     */
    public function byNameAction() {
        return array(
                // ...
        );
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
