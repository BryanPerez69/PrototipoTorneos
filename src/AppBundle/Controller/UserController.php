<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends Controller
{
  /**
    * @Route("/home", name="homepage")
    */
  public function homeAction()
  {
    //Acceso para usuario
    if($this->isGranted("ROLE_USER"))
    {
      $em = $this->getDoctrine()->getManager();

      $torneos = $em->getRepository('AppBundle:Torneos')->findAll();

      return $this->render('usuario/home.html.twig', array('torneos' => $torneos));

    }
    //Acceso para administrador
    elseif ($this->isGranted("ROLE_ADMIN"))
    {
      return $this->render('admin/dashboard.html.twig');
    }
    //No hay ingreso
    elseif ($this->isGranted("IS_AUTHENTICATED_ANONYMOUSLY"))
    {
      return $this->redirectToRoute('index');
    }
  }

}
