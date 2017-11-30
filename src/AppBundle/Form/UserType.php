<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
      ->add('name', TextType::class, array('label' => 'Usuario'))
      ->add('empresa', TextType::class, array('label' => 'Empresa') )
      ->add('nit', TextType::class, array('label' => 'NIT'))
      ->add('email', EmailType::class)
      ->add('plainPassword', RepeatedType::class, array(
              'type' => PasswordType::class,
              'required' => false,
              'first_options'  => array('label' => 'Contraseña'),
              'second_options' => array('label' => 'Repite contraseña')
          ))
      ->add('isActive', CheckboxType::class, array('label' => 'Activo'))
      ->add('role', ChoiceType::class, array('choices' => array(
              'Administrador' => 'ROLE_ADMIN',
              'Usuario' => 'ROLE_USER'), 'placeholder' => 'Seleccionar un tipo'))
      //->add('isactive', HiddenType::class, array('by_reference' => true))
      ->add('guardar', SubmitType::class)
      ->add('borrar', ResetType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
