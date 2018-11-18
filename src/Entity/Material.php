<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Traits\Sluggable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaterialRepository")
 */
class Material
{
    use Sluggable;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isRecycled;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\SiteMaterialListExample", mappedBy="materials")
     */
    private $siteMaterialListExamples;

    public function __construct()
    {
        $this->sites = new ArrayCollection();
        $this->siteMaterialListExamples = new ArrayCollection();
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

    public function getIsRecycled(): ?bool
    {
        return $this->isRecycled;
    }

    public function setIsRecycled(bool $isRecycled): self
    {
        $this->isRecycled = $isRecycled;

        return $this;
    }

    /**
     * @return Collection|SiteMaterialListExample[]
     */
    public function getSiteMaterialListExamples(): Collection
    {
        return $this->siteMaterialListExamples;
    }

    public function addSiteMaterialListExample(SiteMaterialListExample $siteMaterialListExample): self
    {
        if (!$this->siteMaterialListExamples->contains($siteMaterialListExample)) {
            $this->siteMaterialListExamples[] = $siteMaterialListExample;
            $siteMaterialListExample->addMaterial($this);
        }

        return $this;
    }

    public function removeSiteMaterialListExample(SiteMaterialListExample $siteMaterialListExample): self
    {
        if ($this->siteMaterialListExamples->contains($siteMaterialListExample)) {
            $this->siteMaterialListExamples->removeElement($siteMaterialListExample);
            $siteMaterialListExample->removeMaterial($this);
        }

        return $this;
    }
    public  function __toString()
    {
        return $this->name;
    }
}
