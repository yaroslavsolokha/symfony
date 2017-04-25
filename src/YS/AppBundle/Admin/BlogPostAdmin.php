<?php
// src/YS/AppBundle/Admin/BlogPostAdmin.php

namespace YS\AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;


class BlogPostAdmin extends AbstractAdmin
{
  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
    $datagridMapper
      ->add('title')
      ->add('category', null, array(), 'entity', array(
        'class'    => 'YS\AppBundle\Entity\Category',
        'choice_label' => 'name'
      ))
    ;
  }

  protected function configureFormFields(FormMapper $formMapper)
  {
    $formMapper
      ->tab('Post')
        ->with('Content')
          ->add('title', 'text')
          ->add('body', 'textarea')
        ->end()
      ->end()

      ->tab('Publish Options')
        ->with('Meta data')
          ->add('category', 'sonata_type_model', array(
            'class' => 'YS\AppBundle\Entity\Category'
          ))
        ->end()
      ->end()
    ;
  }

  protected function configureListFields(ListMapper $listMapper)
  {
    $listMapper
      ->addIdentifier('title')
      ->add('category.name')
      ->add('draft')
    ;
  }
}