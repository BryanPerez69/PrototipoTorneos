<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

  /**
    * @Route("/home", name="homepage")
    */
  public function homeAction()
  {
    return $this->render('default/home.html.twig');
  }

  /**
    * @Route("/register", name="user_registration")
    */
   public function registerAction(Request $request)
   {
       // 1) build the form
       $user = new User();
       $form = $this->createForm(UserType::class, $user);

       // 2) handle the submit (will only happen on POST)
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {

           // 3) Encode the password (you could also do this via Doctrine listener)
           $password = $this->get('security.password_encoder')
               ->encodePassword($user, $user->getPlainPassword());
           $user->setPassword($password);

           //Ingreso los valores por defecto
           $user->setRole('ROLE_USER');
           $user->setIsActive('1');

           // 4) save the User!
           $em = $this->getDoctrine()->getManager();
           $em->persist($user);
           $em->flush();

           // ... do any other work - like sending them an email, etc
           // maybe set a "flash" success message for the user

           //return $this->redirectToRoute('user_login');
           return new Response('Usuario registrado '.$user->getId());

       }

       return $this->render(
           'default/register.html.twig',
           array('form' => $form->createView())
       );
   }

   /**
     * @Route("/login", name="login")
     */
     public function loginAction(Request $request)
      {
          $authenticationUtils = $this->get('security.authentication_utils');

          // get the login error if there is one
          $error = $authenticationUtils->getLastAuthenticationError();

          // last username entered by the user
          $lastUsername = $authenticationUtils->getLastUsername();

          return $this->render('default/login.html.twig', array(
              'last_username' => $lastUsername,
              'error'         => $error,
          ));
      }



      /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
        // este controller no se ejecutará,
        // ya que la route se maneja por el sistema de seguridad
    }




}
