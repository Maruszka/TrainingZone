<?php

namespace TrainingZoneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

use TrainingZoneBundle\Entity\User;
use TrainingZoneBundle\Form\UserType;

class UserController extends Controller {
    

    public function checkRoleAction() {

        $loggedUser = $this->getUser();
        if ($loggedUser->hasRole('ROLE_USER')) {
            //if user redirect to mainPage
            return $this->redirectToRoute("TrainingZoneBundle:User:userIndex.html.twig");
        } else {
            //if Admin redirect to admin panel
            return $this->redirectToRoute("TrainingZoneBundle:User:adminIndex.html.twig");
        }
    }

    /**
     * @Route("/admin")
     * @Template("TrainingZoneBundle:User:adminIndex.html.twig")
     */
    public function adminAction() {

        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied');
        return [];
    }

    /**
     * @Route("/user")
     * @Template("TrainingZoneBundle:User:userIndex.html.twig")
     */
    public function userAction() {

        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Access denied');
        return [];
    }

    /**
     * @Route("admin/add")
     * @Template()
     */
    public function addAction() { //tylko admin ma możliwość dodawania nowych użytkownikow
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $user->setUsername('Marzena');
        $user->setEmail('marzena@gmail.com');
        $user->setPlainPassword('haslo123');
        $user->setEnabled(true);
        $user->setRoles(['ROLE_USER']);
        $userManager->updateUser($user);

        return array('user' => $user);
    }

    /**
     * @Route("admin/showAll")
     * @Template()
     */
    public function showAllAction() {
        $repo = $this->getDoctrine()->getRepository("MapBundle:User");
        $users = $repo->findAll();
        return array('users' => $users);
    }

    /**
     * @Route("admin/delete/{id}")
     * @Template()
     */
    public function deleteAction($id) {#tylko admin może usuwac uzytkownikow
        $em = $this->getDoctrine()->getManager();
        $repo = $this->getDoctrine()->getRepository("TrainingZoneBundle:User");
        $userToDel = $repo->find($id);
        $em->remove($userToDel);
        $em->flush();

        $resp = $this->redirectToRoute("trainingzone_user_showall");
        return $resp;
    }

    /**
     * @Route("user/edit/{id}") 
     * @Method({"GET"})
     * @Template()
     */
    public function editAction($id) { #tylko user może edytowac swoje konto
        $repo = $this->getDoctrine()->getRepository("TrainingZoneBundle:User");
        $user = $repo->find($id);
        return array("user" => $user);
    }

    /**
     * @Route("user/edit/{id}") 
     * @Method({"POST"})
     * 
     */
    public function editPostAction(Request $req, $id) { #tylko user może edytowac swoje konto
        $repo = $this->getDoctrine()->getRepository("TrainingZoneBundle:User");
        $user = $repo->find($id);
        $em = $this->getDoctrine()->getManager();

        $newName = $req->request->get("productName");
        $newDescription = $req->request->get("productDescription");
        $newPrice = $req->request->get("productPrice");
        $newQuantity = $req->request->get("productQuantity");

        $product->setName($newName);
        $product->setDescription($newDescription);
        $product->setPrice($newPrice);
        $product->setQuantity($newQuantity);

        $em->flush();

       return $this->redirectToRoute("thirddaydb_product_show", ["id" => $product->getId()]);
    }

    /**
     * @Route("/show/{id}")
     * @Template()
     */
    public function showAction($id) {
        return array(
                // ...
        );
    }

}
