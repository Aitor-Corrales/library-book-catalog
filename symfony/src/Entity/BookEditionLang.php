<?php

namespace App\Entity;

use App\Repository\BookEditionLangRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookEditionLangRepository::class)
 */
class BookEditionLang
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Translator::class, inversedBy="bookEditionLangs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $translator;

    /**
     * @ORM\ManyToOne(targetEntity=BookEdition::class, inversedBy="bookEditionLangs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bookEdition;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $summary;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $language;

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
        $this->creationDate = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTranslator(): ?Translator
    {
        return $this->translator;
    }

    public function setTranslator(?Translator $translator): self
    {
        $this->translator = $translator;
        return $this;
    }

    public function getBookEdition(): ?BookEdition
    {
        return $this->bookEdition;
    }

    public function setBookEdition(?BookEdition $bookEdition): self
    {
        $this->bookEdition = $bookEdition;
        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;
        return $this;
    }

    public function getCreationDate(): ?DateTimeInterface
    {
        return $this->creationDate;
    }

    public function getLastModificationDate(): ?DateTimeInterface
    {
        return $this->lastModificationDate;
    }

    public function setLastModificationDate(?DateTimeInterface $lastModificationDate): self
    {
        $this->lastModificationDate = $lastModificationDate;
        return $this;
    }
}
