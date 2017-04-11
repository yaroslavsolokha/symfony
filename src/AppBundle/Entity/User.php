<?php

// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\Column(name="facebook_id", type="string", length=255, nullable=true)
   */
  private $facebookId;

  private $facebookAccessToken;

  /**
   * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Group", cascade={"persist"})
   * @ORM\JoinTable(name="fos_user_user_group",
   *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")},
   *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id", onDelete="CASCADE")}
   * )
   */
  protected $groups;

  /**
   * @ORM\ManyToMany(targetEntity="AppBundle\Entity\BusinessCard", cascade={"persist"})
   * @ORM\JoinTable(name="fos_user_business_card",
   *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
   *      inverseJoinColumns={@ORM\JoinColumn(name="business_card_id", referencedColumnName="id")}
   * )
   */
  protected $businessCards;

  public function __construct()
  {
    parent::__construct();

    $this->enabled = true;
    // your own logic
  }

  /**
   * @param string $facebookId
   * @return User
   */
  public function setFacebookId($facebookId)
  {
    $this->facebookId = $facebookId;

    return $this;
  }

  /**
   * @return string
   */
  public function getFacebookId()
  {
    return $this->facebookId;
  }

  /**
   * @param string $facebookAccessToken
   * @return User
   */
  public function setFacebookAccessToken($facebookAccessToken)
  {
    $this->facebookAccessToken = $facebookAccessToken;

    return $this;
  }

  /**
   * @return string
   */
  public function getFacebookAccessToken()
  {
    return $this->facebookAccessToken;
  }

  /**
   * {@inheritdoc}
   */
  public function getBusinessCards()
  {
    return $this->businessCards ?: $this->businessCards = new ArrayCollection();
  }

  /**
   * {@inheritdoc}
   */
  public function getBusinessCardNames()
  {
    $names = array();
    foreach ($this->getBusinessCards() as $businessCard) {
      $names[] = $businessCard->getName();
    }

    return $names;
  }

  /**
   * {@inheritdoc}
   */
  public function hasBusinessCard($name)
  {
    return in_array($name, $this->getBusinessCardNames());
  }

  /**
   * {@inheritdoc}
   */
  public function addBusinessCard($businessCard)
  {
    if (!$this->getBusinessCards()->contains($businessCard)) {
      $this->getBusinessCards()->add($businessCard);
    }

    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function removeBusinessCard($businessCard)
  {
    if ($this->getBusinessCards()->contains($businessCard)) {
      $this->getBusinessCards()->removeElement($businessCard);
    }

    return $this;
  }
}