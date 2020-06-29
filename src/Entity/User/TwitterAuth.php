<?php

namespace App\Entity\User;

use App\Repository\User\TwitterAuthRepository;
use App\Traits\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TwitterAuthRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class TwitterAuth
{
    use TimestampsTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="twitterAuth", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $consumerKey;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $consumerSecret;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $oauthToken;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $oauthTokenSecret;


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getConsumerKey(): ?string
    {
        return $this->consumerKey;
    }

    /**
     * @param string|null $consumerKey
     * @return $this
     */
    public function setConsumerKey(?string $consumerKey): self
    {
        $this->consumerKey = $consumerKey;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getConsumerSecret(): ?string
    {
        return $this->consumerSecret;
    }

    /**
     * @param string|null $consumerSecret
     * @return $this
     */
    public function setConsumerSecret(?string $consumerSecret): self
    {
        $this->consumerSecret = $consumerSecret;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOauthToken(): ?string
    {
        return $this->oauthToken;
    }

    /**
     * @param string|null $oauthToken
     * @return $this
     */
    public function setOauthToken(?string $oauthToken): self
    {
        $this->oauthToken = $oauthToken;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOauthTokenSecret(): ?string
    {
        return $this->oauthTokenSecret;
    }

    /**
     * @param string|null $oauthTokenSecret
     * @return $this
     */
    public function setOauthTokenSecret(?string $oauthTokenSecret): self
    {
        $this->oauthTokenSecret = $oauthTokenSecret;

        return $this;
    }
}
