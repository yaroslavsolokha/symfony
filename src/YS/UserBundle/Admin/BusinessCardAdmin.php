<?php

// src/YS/UserBundle/Admin/BusinessCardAdmin.php

namespace YS\UserBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class BusinessCardAdmin extends AbstractAdmin
{
  protected function configureFormFields(FormMapper $formMapper)
  {
    $formMapper
      ->add('name', 'text')
      ->add('phone', 'text')
    ;
  }

  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
    $datagridMapper->add('phone');
  }

  protected function configureListFields(ListMapper $listMapper)
  {
    $listMapper->addIdentifier('phone');
  }
}