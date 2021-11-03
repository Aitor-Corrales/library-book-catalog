<?php

namespace App\Entity;

use App\Repository\EditorialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EditorialRepository::class)
 */
class Editorial
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
     * @ORM\OneToMany(targetEntity=BookEdition::class, mappedBy="editorial")
     */
    private $bookEditions;

    /**
     * @ORM\OneToMany(targetEntity=Editor::class, mappedBy="editorial", cascade={"remove"})
     */
    private $editors;

    public function __construct()
    {
        $this->bookEditions = new ArrayCollection();
        $this->editors = new ArrayCollection();
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

    /**
     * @return Collection|BookEdition[]
     */
    public function getBookEditions(): Collection
    {
        return $this->bookEditions;
    }

    public function addBookEdition(BookEdition $bookEdition): self
    {
        if (!$this->bookEditions->contains($bookEdition)) {
            $this->bookEditions[] = $bookEdition;
            $bookEdition->setEditorial($this);
        }

        return $this;
    }

    public function removeBookEdition(BookEdition $bookEdition): self
    {
        if ($this->bookEditions->removeElement($bookEdition)) {
            if ($bookEdition->getEditorial() === $this) {
                $bookEdition->setEditorial(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|Editor[]
     */
    public function getEditors(): Collection
    {
        return $this->editors;
    }

    public function addEditor(Editor $editor): self
    {
        if (!$this->editors->contains($editor)) {
            $this->editors[] = $editor;
            $editor->setEditorial($this);
        }
        return $this;
    }

    public function removeEditor(Editor $editor): self
    {
        if ($this->editors->removeElement($editor)) {
            if ($editor->getEditorial() === $this) {
                $editor->setEditorial(null);
            }
        }

        return $this;
    }
}
