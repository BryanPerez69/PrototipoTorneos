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

    $deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'user_delete');

    if($this->isGranted("ROLE_ADMIN"))
    {
      return $this->render('admin/usuarios.html.twig', array('users' => $users, 'delete_form_ajax' => $deleteFormAjax->createView()));
    }
    //se cierra la sesion al salir al index
    elseif($this->isGranted("IS_AUTHENTICATED_ANONYMOUSLY"))
    {
      return $this->redirectToRoute('logout');
    }
  }

  /**
    * @Route("/admin/torneos", name="gestion_torneos")
    */
  public function torneosManagementAction()
  {
    $em = $this->getDoctrine()->getManager();

    $users = $em->getRepository('AppBundle:Torneos')->findAll();

    if($this->isGranted("ROLE_ADMIN"))
    {
      return $this->render('admin/torneos.html.twig', array('users' => $users));
    }
    //se cierra la sesion al salir al index
    elseif($this->isGranted("IS_AUTHENTICATED_ANONYMOUSLY"))
    {
      return $this->redirectToRoute('logout');
    }


  }



  public function deleteAction(Request $request, $id)
  {

    $em = $this->getDoctrine()->getManager();

    $user = $em->getRepository('AppBundle:User')->find($id);

    if(!$user)
    {
      throw $this->createNotfoundException('Usuario no encontrado');
    }

    $form = $this->createCustomForm($user->getId(), 'DELETE', 'user_delete');
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
      //peticion ajax
      if($request->isXMLHttpRequest())
      {
        $res = $this->deleteUser($user->getRole(), $em, $user);

        return new Response(
          json_encode(array('removed' => $res['removed'], 'message' => $res['message'])),
          200,
          array('content-Type' => 'aplication/json')
        );
      }

      //$res = $this->deleteUser($user->getrole(), $em, $user);

      $this->addFlash($res['alert'], $res['message']);
      return $this->redirectToRoute('gestion_usuarios');
    }
  }

  private function deleteUser($role, $em, $user)
  {
    if($role == 'ROLE_USER')
    {
      $em->remove($user);
      $em->flush();

      $message = 'El usuario ha sido eliminado';
      $removed = 1;
      $alert = 'mensaje';
    }
    elseif($role == 'ROLE_ADMIN')
    {
      $message = 'El usuario no ha sido eliminado';
      $removed = 0;
      $alert = 'error';
    }

    return array('removed' => $removed, 'message' => $message, 'alert' => $alert);
  }

  private function createCustomForm($id, $method, $route)
  {
    return $this->createFormBuilder()
    ->setAction($this->generateUrl($route, array('id'=>$id)))
    ->setMethod($method)
    ->getForm();
  }

}
