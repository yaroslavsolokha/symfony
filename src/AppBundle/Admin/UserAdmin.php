<?php

// src/AppBundle/Admin/UserAdmin.php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends AbstractAdmin
{
  protected function configureFormFields(FormMapper $formMapper)
  {
    $formMapper
      ->add('username', 'text')
      ->add('email', 'text')
      ->add('password', 'password')
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
    ;
  }

  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
    $datagridMapper->add('username');
  }

  protected function configureListFields(ListMapper $listMapper)
  {
    $listMapper->addIdentifier('username');
  }
}