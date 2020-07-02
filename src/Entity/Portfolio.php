<?php

namespace App\Entity;

use App\Repository\PortfolioRepository;
use App\Traits\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=PortfolioRepository::class)
 * @Vich\Uploadable()
 * @ORM\HasLifecycleCallbacks()
 */
class Portfolio
{
    use TimestampsTrait;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @Vich\UploadableField(mapping="avatars", fileNameProperty="imageUrl")
     * @var File|null
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $twitterUserName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="boolean")
     */
    private $setData = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return $this
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param File|null $file
     * @throws \Exception
     */
    public function setFile(?File $file = null): void
    {
        $this->file = $file;

        if (null !== $file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    /**
     * @return File|null
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * @param string|null $imageUrl
     * @return $this
     */
    public function setImageUrl(?string $imageUrl): self
    {
        if (strstr($imageUrl, 'http')) {
            $this->imageUrl = $imageUrl;
        } else {
            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                $link = "https://";
            } else {
                $link = "http://";
            }
            $link .= $_SERVER['HTTP_HOST'] . '/images/avatars/';
            $this->imageUrl = $link . $imageUrl;
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTwitterUserName(): ?string
    {
        return $this->twitterUserName;
    }

    /**
     * @param string|null $twitterUserName
     * @return $this
     */
    public function setTwitterUserName(?string $twitterUserName): self
    {
        $this->twitterUserName = $twitterUserName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return $this
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSetData(): ?bool
    {
        return $this->setData;
    }

    /**
     * @param bool $setData
     * @return $this
     */
    public function setSetData(bool $setData): self
    {
        $this->setData = $setData;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
