<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
  /**
    * @Route("/admin", name="administrator")
    */
  public function principalAction()
  {

  }

  /**
    * @Route("/admin/usuarios", name="gestion_usuarios")
    */
  public function userManagementAction()
  {
    $em = $this->getDoctrine()->getManager();

    $users = $em->getRepository('AppBundle:User')->findAll();

    return $this->render('admin/usuarios.html.twig', array('users' => $users));
  }
}
