<?php

// src/UserBundle/Admin/UserAdmin.php

namespace UserBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\UserBundle\Admin\Model\UserAdmin as SonataUserAdmin;


class UserAdmin extends SonataUserAdmin
{
  /**
   * {@inheritdoc}
   */
  protected function configureFormFields(FormMapper $formMapper)
  {
    parent::configureFormFields($formMapper);

    $formMapper
      ->tab('Business Cards')
        ->with('General')
          ->add('businessCards', 'sonata_type_collection',
              array(),
              array(
                'edit' => 'inline',
                'inline' => 'table',
              )
            )
        ->end()
      ->end()
      ->remove('phone')
    ;

    //$formMapper->remove('some field');
    /*$formMapper
      ->add('username', 'text')
      ->add('email', 'text')
      ->add('plainPassword', 'password')
      ->add('enabled', 'checkbox', array('required' => false))
      ->add('groups', 'sonata_type_model_autocomplete', array(
        'multiple' => true,
        'property' => 'name'
      ))
      ->add('businessCards', 'sonata_type_collection',
        array(),
        array(
          'edit' => 'inline',
          'inline' => 'table',
        )
      )
    ;*/
  }
}