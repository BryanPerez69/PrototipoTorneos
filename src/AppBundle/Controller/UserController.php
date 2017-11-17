<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Torneos;
use AppBundle\Entity\TipoTorneo;

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
      return $this->render('admin/admin-area.html.twig');
    }
    //No hay ingreso
    elseif ($this->isGranted("IS_AUTHENTICATED_ANONYMOUSLY"))
    {
      return $this->redirectToRoute('index');
    }
  }

  /**
   * @Route("/torneo/{section}", name="torneo_section")
   */
  public function torneoSectionAction($section){

    $em = $this->getDoctrine()->getManager();

    $query = "SELECT t FROM AppBundle:Torneos t JOIN AppBundle:TipoTorneo tt WITH t.deporte=tt.id WHERE tt.descripcion = '$section'";

    $torneos_section = $em->createQuery($query)->getResult();

    /*$torneos_section = $em->getRepository('AppBundle:Torneos')->findBy(array('deporte' => 2));*/

    //return new Response($torneos_section->getResult());

    return $this->render('usuario/torneos_section.html.twig', array('torneos_section' => $torneos_section));

  }

  /**
   * @Route("/carnet", name="carnet")
   */
  public function carnetAction()
  {
    return $this->render('usuario/carnet.html.twig');
  }

}
