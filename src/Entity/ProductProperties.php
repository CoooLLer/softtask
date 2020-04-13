<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductPropertiesRepository")
 */
class ProductProperties
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $model;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $width;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $height;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $cordType;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $diameter;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $loadIndex;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $speedSymbol;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $designates;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $runflatAbbreviation;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $tubeType;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $season;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getCordType(): ?string
    {
        return $this->cordType;
    }

    public function setCordType(?string $cordType): self
    {
        $this->cordType = $cordType;

        return $this;
    }

    public function getDiameter(): ?int
    {
        return $this->diameter;
    }

    public function setDiameter(?int $diameter): self
    {
        $this->diameter = $diameter;

        return $this;
    }

    public function getLoadIndex(): ?int
    {
        return $this->loadIndex;
    }

    public function setLoadIndex(?int $loadIndex): self
    {
        $this->loadIndex = $loadIndex;

        return $this;
    }

    public function getSpeedSymbol(): ?string
    {
        return $this->speedSymbol;
    }

    public function setSpeedSymbol(?string $speedSymbol): self
    {
        $this->speedSymbol = $speedSymbol;

        return $this;
    }

    public function getDesignates(): ?string
    {
        return $this->designates;
    }

    public function setDesignates(?string $designates): self
    {
        $this->designates = $designates;

        return $this;
    }

    public function getRunflatAbbreviation(): ?string
    {
        return $this->runflatAbbreviation;
    }

    public function setRunflatAbbreviation(?string $runflatAbbreviation): self
    {
        $this->runflatAbbreviation = $runflatAbbreviation;

        return $this;
    }

    public function getTubeType(): ?string
    {
        return $this->tubeType;
    }

    public function setTubeType(?string $tubeType): self
    {
        $this->tubeType = $tubeType;

        return $this;
    }

    public function getSeason(): ?string
    {
        return $this->season;
    }

    public function setSeason(?string $season): self
    {
        $this->season = $season;

        return $this;
    }
}
