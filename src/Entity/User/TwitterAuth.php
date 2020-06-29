<?php

namespace App\Entity\User;

use App\Repository\User\TwitterAuthRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TwitterAuthRepository::class)
 */
class TwitterAuth
{
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


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getConsumerKey(): ?string
    {
        return $this->consumerKey;
    }

    public function setConsumerKey(?string $consumerKey): self
    {
        $this->consumerKey = $consumerKey;

        return $this;
    }

    public function getConsumerSecret(): ?string
    {
        return $this->consumerSecret;
    }

    public function setConsumerSecret(?string $consumerSecret): self
    {
        $this->consumerSecret = $consumerSecret;

        return $this;
    }

    public function getOauthToken(): ?string
    {
        return $this->oauthToken;
    }

    public function setOauthToken(?string $oauthToken): self
    {
        $this->oauthToken = $oauthToken;

        return $this;
    }

    public function getOauthTokenSecret(): ?string
    {
        return $this->oauthTokenSecret;
    }

    public function setOauthTokenSecret(?string $oauthTokenSecret): self
    {
        $this->oauthTokenSecret = $oauthTokenSecret;

        return $this;
    }
}
