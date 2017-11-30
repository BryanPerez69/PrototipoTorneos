<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormError;

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

    $blockFormAjax = $this->createCustomForm(':USER_ID', 'PUT', 'user_block');

    $unblockFormAjax = $this->createCustomForm(':USER_ID', 'PUT', 'user_unblock');

    if($this->isGranted("ROLE_ADMIN"))
    {

      return $this->render('admin/usuarios.html.twig', array('users' => $users, 'delete_form_ajax' => $deleteFormAjax->createView(), 'block_form_ajax'=> $blockFormAjax->createView(), 'unblock_form_ajax'=> $unblockFormAjax->createView()));
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

  ##############################################################################
  #####################ACCIONES PARA CREAR UN USUARIO##########################
  ##############################################################################

  /**
  * @Route("/admin/usuarios/nuevo", name="nuevo_usuario")
  * @Method("POST")
  */
  public function nuevoUsuarioAction(Request $request)
  {
    // 1) build the form
    $user = new User();
    $form = $this->createForm(UserType::class, $user);

    // 2) handle the submit (will only happen on POST)
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

        $plainPassword = $form->get('plainPassword')->getData();

        $passwordConstraint = new Assert\NotBlank();
        $errorList = $this->get('validator')->validate($plainPassword, $passwordConstraint);


        if(count($errorList) == 0)
        {
          // 3) Encode the password (you could also do this via Doctrine listener)
          $password = $this->get('security.password_encoder')
              ->encodePassword($user, $user->getPlainPassword());
          $user->setPassword($password);


          // 4) save the User!
          $em = $this->getDoctrine()->getManager();
          $em->persist($user);
          $em->flush();

          // ... do any other work - like sending them an email, etc
          // maybe set a "flash" success message for the user

          return $this->redirectToRoute('gestion_usuarios');
          //return new Response('Usuario registrado '.$user->getId());
        }
        else
        {
          $errorMessage = new FormError($errorList[0]->getMessage());
          $form->get('plainPassword')->get('first')->addError($errorMessage);
          $form->get('plainPassword')->get('second')->addError($errorMessage);
        }



    }

    return $this->render('admin/nuevo_usuario.html.twig', array('form'=> $form->createView()));

  }


  ##############################################################################
  #####################ACCIONES PARA EDITAR UN USUARIO##########################
  ##############################################################################

  public function editAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $user = $em->getRepository('AppBundle:User')->find($id);

    $form = $this->createForm(UserType::class, $user);

    $currentPassword = $user->getPassword();

    // 2) handle the submit (will only happen on POST)
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

        $plainPassword = $form->get('plainPassword')->getData();

        if (!empty($plainPassword)) {


          $encoder = $this->get('security.password_encoder');
          $encoded = $encoder->encodePassword($user, $user->getPlainPassword());
          $user->setPassword($encoded);

        }
        else{
          $user->setPassword($currentPassword);
        }
        // 3) Encode the password (you could also do this via Doctrine listener)
        // $password = $this->get('security.password_encoder')
        //     ->encodePassword($user, $user->getPlainPassword());
        // $user->setPassword($password);
        if($form->get('role')->getData() == 'ROLE_ADMIN')
        {
          $user->setIsActive(1);
        }

        // 4) save the User!
        // $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        // ... do any other work - like sending them an email, etc
        // maybe set a "flash" success message for the user

        return $this->redirectToRoute('gestion_usuarios');
        //return new Response('Usuario registrado '.$user->getId());

    }

    return $this->render('admin/editar_usuario.html.twig', array('user'=>$user, 'form'=> $form->createView()));

  }

  ##############################################################################
  #####################ACCIONES PARA BORRAR UN USUARIO##########################
  ##############################################################################


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

  ##############################################################################
  ############ACCIONES PARA BLOQUEAR/DESBLOQUEAR UN USUARIO#####################
  ##############################################################################

  public function blockAction(Request $request, $id)
  {

    $em = $this->getDoctrine()->getManager();

    $user = $em->getRepository('AppBundle:User')->find($id);

    if(!$user)
    {
      throw $this->createNotfoundException('Usuario no encontrado');
    }

    $form = $this->createCustomForm($user->getId(), 'PUT', 'user_block');
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
      //peticion ajax
      if($request->isXMLHttpRequest())
      {
        $res = $this->blockUser($user->getRole(), $em, $user);

        return new Response(
          json_encode(array('blocked' => $res['blocked'], 'message' => $res['message'])),
          200,
          array('content-Type' => 'aplication/json')
        );
      }
    }

  }

  private function blockUser($role, $em, $user)
  {

    if($role == 'ROLE_USER')
    {
      $user->setIsActive('0');
      $em->flush();

      $message = 'El usuario ha sido bloqueado';
      $blocked = 1;
      $alert = 'mensaje';
    }
    elseif($role == 'ROLE_ADMIN')
    {
      $message = 'El usuario no ha sido bloqueado';
      $blocked = 0;
      $alert = 'error';
    }

    return array('blocked' => $blocked, 'message' => $message, 'alert' => $alert);
  }

  public function unblockAction(Request $request, $id)
  {

    $em = $this->getDoctrine()->getManager();

    $user = $em->getRepository('AppBundle:User')->find($id);

    if(!$user)
    {
      throw $this->createNotfoundException('Usuario no encontrado');
    }

    $form = $this->createCustomForm($user->getId(), 'PUT', 'user_unblock');
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
      //peticion ajax
      if($request->isXMLHttpRequest())
      {
        $res = $this->unblockUser($user->getRole(), $em, $user);

        return new Response(
          json_encode(array('unblocked' => $res['unblocked'], 'message' => $res['message'])),
          200,
          array('content-Type' => 'aplication/json')
        );
      }
    }
  }

  private function unblockUser($role, $em, $user)
  {

    if($role == 'ROLE_USER')
    {
      $user->setIsActive('1');
      $em->flush();

      $message = 'El usuario ha sido desbloqueado';
      $unblocked = 1;
      $alert = 'mensaje';
    }
    elseif($role == 'ROLE_ADMIN')
    {
      $message = 'El usuario no ha sido desbloqueado';
      $unblocked = 0;
      $alert = 'error';
    }

    return array('unblocked' => $unblocked, 'message' => $message, 'alert' => $alert);
  }

  private function createCustomForm($id, $method, $route)
  {
    return $this->createFormBuilder()
    ->setAction($this->generateUrl($route, array('id'=>$id)))
    ->setMethod($method)
    ->getForm();
  }



}
