<?php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class RegistrationFormType extends AbstractType
{
  /**
   * {@inheritdoc}
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('gender');
    //echo 2;
    //exit;
    //parent::buildForm($builder, $options);

  }

  public function getParent()
  {
    return 'FOS\UserBundle\Form\Type\RegistrationFormType';
  }

  public function getName()
  {
    return 'user_registration';
  }

}