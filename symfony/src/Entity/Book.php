<?php

namespace App\Entity;

use App\Repository\BookRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Author::class, inversedBy="books")
     */
    private $authors;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="books")
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity=BookEdition::class, mappedBy="book")
     */
    private $bookEditions;

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
        $this->authors = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->bookEditions = new ArrayCollection();
        $this->creationDate = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Author[]
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthor(Author $author): self
    {
        if (!$this->authors->contains($author)) {
            $this->authors[] = $author;
        }

        return $this;
    }

    public function removeAuthor(Author $author): self
    {
        $this->authors->removeElement($author);

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->removeElement($tag);

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
            $bookEdition->setBook($this);
        }

        return $this;
    }

    public function removeBookEdition(BookEdition $bookEdition): self
    {
        if ($this->bookEditions->removeElement($bookEdition)) {
            if ($bookEdition->getBook() === $this) {
                $bookEdition->setBook(null);
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

}
