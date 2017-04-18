<?php

// src/UserBundle/Entity/User.php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Sonata\UserBundle\Entity\BaseUser as SonataUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends SonataUser
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true)
   */
  private $facebookAccessToken;

  /**
   * @ORM\Column(name="gplus_access_token", type="string", length=255, nullable=true)
   */
  private $gplusAccessToken;

  /**
   * @ORM\ManyToMany(targetEntity="UserBundle\Entity\Group", cascade={"persist"})
   * @ORM\JoinTable(name="fos_user_user_group",
   *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")},
   *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id", onDelete="CASCADE")}
   * )
   */
  protected $groups;

  /**
   * @ORM\ManyToMany(targetEntity="UserBundle\Entity\BusinessCard", cascade={"persist", "remove"})
   * @ORM\JoinTable(name="fos_user_business_card",
   *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")},
   *      inverseJoinColumns={@ORM\JoinColumn(name="business_card_id", referencedColumnName="id", onDelete="CASCADE")}
   * )
   */
  protected $businessCards;

  /**
   * @ORM\ManyToMany(targetEntity="UserBundle\Entity\Tag", cascade={"persist"})
   * @ORM\JoinTable(name="fos_user_tag",
   *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
   *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
   * )
   */
  protected $tags;

  public function __construct()
  {
    parent::__construct();
    // your own logic
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
   * @param string $gplusAccessToken
   * @return User
   */
  public function setGplusAccessToken($gplusAccessToken)
  {
    $this->gplusAccessToken = $gplusAccessToken;

    return $this;
  }

  /**
   * @return string
   */
  public function getGplusAcessToken()
  {
    return $this->gplusAccessToken;
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

  /**
   * {@inheritdoc}
   */
  public function getTags()
  {
    return $this->tags ?: $this->tags = new ArrayCollection();
  }

  /**
   * {@inheritdoc}
   */
  public function getTagNames()
  {
    $names = array();
    foreach ($this->getTags() as $tag) {
      $names[] = $tag->getName();
    }

    return $names;
  }

  /**
   * {@inheritdoc}
   */
  public function hasTag($name)
  {
    return in_array($name, $this->getTagNames());
  }

  /**
   * {@inheritdoc}
   */
  public function addTag($tag)
  {
    if (!$this->getTags()->contains($tag)) {
      $this->getTags()->add($tag);
    }

    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function removeTag($tag)
  {
    if ($this->getTags()->contains($tag)) {
      $this->getTags()->removeElement($tag);
    }

    return $this;
  }
}