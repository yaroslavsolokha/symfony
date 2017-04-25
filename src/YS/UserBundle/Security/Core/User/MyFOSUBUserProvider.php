<?php

namespace YS\UserBundle\Security\Core\User;

use YS\UserBundle\Entity\User;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseFOSUBProvider;
use Symfony\Component\Security\Core\User\UserInterface;

class MyFOSUBUserProvider extends BaseFOSUBProvider
{
  /**
   * {@inheritDoc}
   */
  public function connect(UserInterface $user, UserResponseInterface $response)
  {
    // get property from provider configuration by provider name
    // , it will return `facebook_id` in that case (see service definition below)
    $property = $this->getProperty($response);
    $username = $response->getUsername(); // get the unique user identifier

    //we "disconnect" previously connected users
    $existingUser = $this->userManager->findUserBy(array($property => $username));
    if (null !== $existingUser) {
      // set current user id and token to null for disconnect
      // ...

      $this->userManager->updateUser($existingUser);
    }
    // we connect current user, set current user id and token
    // ...
    $this->userManager->updateUser($user);
  }

  /**
   * {@inheritdoc}
   */
  public function loadUserByOAuthUserResponse(UserResponseInterface $response)
  {
    $userEmail = $response->getEmail();
    $serviceName = $response->getResourceOwner()->getName();
    $user = $this->userManager->findUserByEmail($userEmail);
    $setterData = 'set' . ucfirst($serviceName) . 'Data';
    $setterName = 'set' . ucfirst($serviceName) . 'Name';
    $setterAccessToken = 'set' . ucfirst($serviceName) . 'AccessToken';
    $getterData = 'get' . ucfirst($serviceName) . 'Data';
    $getterName = 'get' . ucfirst($serviceName) . 'Name';

    if (null === $user) {
      // if null just create new user and set it properties
      //@todo add exception if does not exist email
      $user = new User();
      $user->$setterAccessToken($response->getAccessToken());
      $user->$setterName($response->getFirstName().' '.$response->getLastName());
      $user->setUsername($userEmail);
      $user->setEmail($userEmail);
      $user->setFirstname($response->getFirstName());
      $user->setLastname($response->getLastName());
      $user->setPassword('');
      $user->setEnabled(true);
      $this->userManager->updateUser($user);
    } else {
      if(!$user->$getterData()){
        $user->$setterData($response->getResponse());
      }
      if(!$user->$getterName()){
        $user->$setterName($response->getFirstName().' '.$response->getLastName());
      }
      $user->$setterAccessToken($response->getAccessToken());
    }

    return $user;
  }
}