<?php

namespace App\Entity;

use App\Repository\TranslatorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TranslatorRepository::class)
 */
class Translator
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=BookEditionLang::class, mappedBy="translator")
     */
    private $bookEditionLangs;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastModificationDate;

    public function __construct()
    {
        $this->bookEditionLangs = new ArrayCollection();
        $this->creationDate = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|BookEditionLang[]
     */
    public function getBookEditionLangs(): Collection
    {
        return $this->bookEditionLangs;
    }

    public function addBookEditionLang(BookEditionLang $bookEditionLang): self
    {
        if (!$this->bookEditionLangs->contains($bookEditionLang)) {
            $this->bookEditionLangs[] = $bookEditionLang;
            $bookEditionLang->setTranslator($this);
        }

        return $this;
    }

    public function removeBookEditionLang(BookEditionLang $bookEditionLang): self
    {
        if ($this->bookEditionLangs->removeElement($bookEditionLang)) {
            if ($bookEditionLang->getTranslator() === $this) {
                $bookEditionLang->setTranslator(null);
            }
        }

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function getLastModificationDate(): ?\DateTimeInterface
    {
        return $this->lastModificationDate;
    }

    public function setLastModificationDate(?\DateTimeInterface $lastModificationDate): self
    {
        $this->lastModificationDate = $lastModificationDate;
        return $this;
    }
}
