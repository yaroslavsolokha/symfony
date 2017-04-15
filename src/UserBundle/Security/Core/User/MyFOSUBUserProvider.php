<?php

namespace UserBundle\Security\Core\User;

use UserBundle\Entity\User;
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
    $username = $response->getUsername();
    $userEmail = $response->getEmail();
    $serviceName = $response->getResourceOwner()->getName();
    $user = $this->userManager->findUserByEmail($userEmail);
    $setterId = 'set' . ucfirst($serviceName) . 'Id';
    $setterAccessToken = 'set' . ucfirst($serviceName) . 'AccessToken';
    $getterId = 'get' . ucfirst($serviceName) . 'Id';

    if (null === $user) {
      // if null just create new user and set it properties
      $user = $this->userManager->createUser();
      $user->$setterId($username);
      $user->$setterAccessToken($response->getAccessToken());
      $user->setUsername($userEmail);
      $user->setEmail($userEmail);
      $user->setPassword('');
      $user->setEnabled(true);
      $this->userManager->updateUser($user);
    } else {
      // else update access token of existing user
      if(!$user->$getterId()){
        $user->$setterId($username);
      }
      $user->$setterAccessToken($response->getAccessToken());
    }

    return $user;
  }
}