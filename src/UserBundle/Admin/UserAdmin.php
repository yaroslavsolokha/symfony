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
      ->tab('Tags')
        ->with('General')
          ->add('tags', 'sonata_type_model_autocomplete', array(
              'multiple' => true,
              'property' => 'name'
            )
          )
        ->end()
      ->end()
      ->remove('phone')
    ;
  }
}