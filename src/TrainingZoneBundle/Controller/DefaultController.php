<?php

namespace TrainingZoneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TrainingZoneBundle\Entity\Training;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository("TrainingZoneBundle:Category");
        $allCategories = $repo->findAll();
        $repo2 = $this->getDoctrine()->getRepository("TrainingZoneBundle:Training");
        $listOfTrainings = $repo2->findAll();
       return array("allCategories" => $allCategories, "list"=>$listOfTrainings );
    }
}
