<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isCorrectTitle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductCategory")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ProductProperties", cascade={"persist", "remove"})
     */
    private $properties;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIsCorrectTitle(): ?bool
    {
        return $this->isCorrectTitle;
    }

    public function setIsCorrectTitle(?bool $isCorrectTitle): self
    {
        $this->isCorrectTitle = $isCorrectTitle;

        return $this;
    }

    public function getCategory(): ?ProductCategory
    {
        return $this->category;
    }

    public function setCategory(?ProductCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getProperties(): ?ProductProperties
    {
        return $this->properties;
    }

    public function setProperties(?ProductProperties $properties): self
    {
        $this->properties = $properties;

        return $this;
    }
}
