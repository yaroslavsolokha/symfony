<?php

// src/YS/UserBundle/Entity/User.php

namespace YS\UserBundle\Entity;

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
   * @ORM\ManyToMany(targetEntity="YS\UserBundle\Entity\Group", cascade={"persist"})
   * @ORM\JoinTable(name="fos_user_user_group",
   *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")},
   *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id", onDelete="CASCADE")}
   * )
   */
  protected $groups;

  /**
   * @ORM\ManyToMany(targetEntity="YS\UserBundle\Entity\Tag", cascade={"persist"})
   * @ORM\JoinTable(name="fos_user_tag",
   *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")},
   *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id", onDelete="CASCADE")}
   * )
   */
  protected $tags;

  /**
   * @ORM\OneToMany(targetEntity="YS\UserBundle\Entity\BusinessCard", mappedBy="user", cascade={"persist"}, orphanRemoval=true)
   */
  protected $businessCards;

  public function __construct()
  {
    parent::__construct();
    $this->businessCards = new ArrayCollection();
    $this->tags = new ArrayCollection();
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
    return $this->businessCards;
  }

  /**
   * {@inheritdoc}
   */
  public function setBusinessCards($businessCards)
  {
    if (count($businessCards) > 0) {
      foreach ($businessCards as $businessCard) {
        $this->addBusinessCard($businessCard);
      }
    }

    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function addBusinessCard(BusinessCard $businessCard)
  {
    $businessCard->setUser($this);
    $this->businessCards->add($businessCard);
  }

  public function removeBusinessCard(BusinessCard $businessCard)
  {
    $this->businessCards->removeElement($businessCard);
  }

  /**
   * {@inheritdoc}
   */
  public function getTags()
  {
    return $this->tags;
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