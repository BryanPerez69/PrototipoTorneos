<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormError;

class IndexController extends Controller
{


   /**
     * @Route("/", name="index")
     */
     public function indexAction(Request $request)
      {
          //-----------------------------LOGIN----------------------------------

          $authenticationUtils = $this->get('security.authentication_utils');

          // get the login error if there is one
          $error = $authenticationUtils->getLastAuthenticationError();

          // last username entered by the user
          $lastUsername = $authenticationUtils->getLastUsername();


          //----------------------------REGISTRO--------------------------------

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

                //Ingreso los valores por defecto
                $user->setRole('ROLE_USER');
                $user->setIsActive('1');

                // 4) save the User!
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                // ... do any other work - like sending them an email, etc
                // maybe set a "flash" success message for the user

                return $this->redirectToRoute('index');
                //return new Response('Usuario registrado '.$user->getId());
              }
              else
              {
                $errorMessage = new FormError($errorList[0]->getMessage());
                $form->get('plainPassword')->get('first')->addError($errorMessage);
                $form->get('plainPassword')->get('second')->addError($errorMessage);
              }


          }

          //se cierra la sesion al salir al index
          if($this->isGranted("IS_AUTHENTICATED_FULLY"))
          {
           return $this->redirectToRoute('logout');
          }

          return $this->render('index/index.html.twig', array(
              'last_username' => $lastUsername,
              'error'         => $error,
              'form'          => $form->createView(),
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

    /**
    * @Route("/logout", name="logout")
    */
    public function logoutAction()
    {

    }



}
