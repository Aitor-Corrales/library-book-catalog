<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EditorRepository::class)
 */
class Editor
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
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastModificationDate;

    /**
     * @ORM\ManyToOne(targetEntity=Editorial::class, inversedBy="editors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $editorial;

    /**
     * @ORM\OneToMany(targetEntity=BookEdition::class, mappedBy="editor")
     */
    private $bookEditions;

    public function __construct()
    {
        $this->creationDate = new \DateTime();
        $this->bookEditions = new ArrayCollection();
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

    public function getEditorial(): ?Editorial
    {
        return $this->editorial;
    }

    public function setEditorial(?Editorial $editorial): self
    {
        $this->editorial = $editorial;

        return $this;
    }

    /**
     * @return Collection|BookEdition[]
     */
    public function getBookEditions(): Collection
    {
        return $this->bookEditions;
    }
}
