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
     * @ORM\ManyToMany(targetEntity="App\Entity\SiteMaterialsExample", mappedBy="materials")
     */
    private $siteMaterialsExample;

    public function __construct()
    {
        $this->sites = new ArrayCollection();
        $this->siteMaterialsExample = new ArrayCollection();
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
     * @return Collection|SiteMaterialsExample[]
     */
    public function getSiteMaterialsExample(): Collection
    {
        return $this->siteMaterialsExample;
    }

    public function addSiteMaterialsExample(SiteMaterialsExample $siteMaterialsExample): self
    {
        if (!$this->siteMaterialsExample->contains($siteMaterialsExample)) {
            $this->siteMaterialsExample[] = $siteMaterialsExample;
            $siteMaterialsExample->addMaterial($this);
        }

        return $this;
    }

    public function removeSiteMaterialsExample(SiteMaterialsExample $siteMaterialsExample): self
    {
        if ($this->siteMaterialsExample->contains($siteMaterialsExample)) {
            $this->siteMaterialsExample->removeElement($siteMaterialsExample);
            $siteMaterialsExample->removeMaterial($this);
        }

        return $this;
    }
    public  function __toString()
    {
        return $this->name;
    }
}
