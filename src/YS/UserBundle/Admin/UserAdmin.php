<?php

// src/YS/UserBundle/Admin/UserAdmin.php

namespace YS\UserBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\UserBundle\Admin\Model\UserAdmin as SonataUserAdmin;

class UserAdmin extends SonataUserAdmin
{
  public function prePersist($user)
  {
    parent::prePersist($user);
    $this->preUpdate($user);
  }

  public function preUpdate($user)
  {
    parent::preUpdate($user);
    $user->setBusinessCards($user->getBusinessCards());
  }

  /**
   * {@inheritdoc}
   */
  protected function configureListFields(ListMapper $listMapper)
  {
    parent::configureListFields($listMapper);
    $listMapper->remove('impersonating');
  }

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
              array(
                'required' => false
              ),
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
              'required' => false,
              'multiple' => true,
              'property' => 'name'
            )
          )
        ->end()
      ->end()
      ->remove('phone')
      ->remove('website')
      ->remove('biography')
      ->remove('locale')
      ->remove('timezone')
      ->remove('facebookUid')
      ->remove('twitterUid')
      ->remove('twitterName')
      ->remove('gplusUid')
      ->remove('token')
      ->remove('twoStepVerificationCode')
    ;
  }
}