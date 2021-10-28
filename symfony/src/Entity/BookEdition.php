<?php

namespace App\Entity;

use App\Repository\BookEditionRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookEditionRepository::class)
 */
class BookEdition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $edition;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class, inversedBy="bookEditions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $book;

    /**
     * @ORM\OneToMany(targetEntity=BookEditionLang::class, mappedBy="bookEdition")
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

    /**
     * @ORM\ManyToOne(targetEntity=Editorial::class, inversedBy="bookEditions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $editorial;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEdition(): ?int
    {
        return $this->edition;
    }

    public function setEdition(int $edition): self
    {
        $this->edition = $edition;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }

    /**
     * @return Collection|BookEdition[]
     */
    public function getBookEditionLangs(): Collection
    {
        return $this->bookEditionLangs;
    }

    public function addBookEditionLang(BookEditionLang $bookEditionLang): self
    {
        if (!$this->bookEditionLangs->contains($bookEditionLang)) {
            $this->bookEditionLangs[] = $bookEditionLang;
            $bookEditionLang->setBookEdition($this);
        }
        return $this;
    }

    public function removeBookEditionLang(BookEditionLang $bookEditionLang): self
    {
        if ($this->bookEditionLangs->removeElement($bookEditionLang)) {
            if ($bookEditionLang->getBookEdition() === $this) {
                $bookEditionLang->setBookEdition(null);
            }
        }
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

    public function getEditorial(): ?Editorial
    {
        return $this->editorial;
    }

    public function setEditorial(?Editorial $editorial): self
    {
        $this->editorial = $editorial;

        return $this;
    }
}
