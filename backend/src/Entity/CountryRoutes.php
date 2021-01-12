<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="routes")
 */
class CountryRoutes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="routes")
     */
    private $countrySource;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class)
     */
    private $countryDestination;

    /**
     * @ORM\Column(type="boolean")
     */
    private $possiblePath;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->countrySource = new ArrayCollection();
        $this->countryDestination = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Country[]
     */
    public function getCountrySource(): Collection
    {
        return $this->countrySource;
    }

    public function addCountrySource(Country $countrySource): self
    {
        if (!$this->countrySource->contains($countrySource)) {
            $this->countrySource[] = $countrySource;
        }

        return $this;
    }

    public function removeCountrySource(Country $countrySource): self
    {
        $this->countrySource->removeElement($countrySource);

        return $this;
    }

    /**
     * @return Collection|Country[]
     */
    public function getCountryDestination(): Collection
    {
        return $this->countryDestination;
    }

    public function addCountryDestination(Country $countryDestination): self
    {
        if (!$this->countryDestination->contains($countryDestination)) {
            $this->countryDestination[] = $countryDestination;
        }

        return $this;
    }

    public function removeCountryDestination(Country $countryDestination): self
    {
        $this->countryDestination->removeElement($countryDestination);

        return $this;
    }

    public function getPossiblePath(): ?bool
    {
        return $this->possiblePath;
    }

    public function setPossiblePath(bool $possiblePath): self
    {
        $this->possiblePath = $possiblePath;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
