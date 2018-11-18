<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Traits\Sluggable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SiteRepository")
 */
class Site
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
     * @ORM\ManyToOne(targetEntity="App\Entity\SiteManager", inversedBy="sites", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false, name="manager_id", referencedColumnName="id")
     */
    private $manager;

    /**
     * @ORM\Column(type="integer")
     */
    private $recyclingRate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SiteMaterial", mappedBy="site", orphanRemoval=true, cascade={"all"})
     */
    private $siteMaterials;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $estimatedFinishDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Label", inversedBy="sites", cascade={"persist"})
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $street;

    /**
     * @ORM\Column(type="integer")
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->siteMaterials = new ArrayCollection();
        $this->startDate = new \DateTime();
        $this->updatedAt = new \DateTime();
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

    public function getManager(): ?User
    {
        return $this->manager;
    }

    public function setManager(?User $manager): self
    {
        $this->manager = $manager;

        return $this;
    }

    public function getRecyclingRate()
    {
        return $this->recyclingRate;
    }

    public function setRecyclingRate($recyclingRate)
    {
        $this->recyclingRate = $recyclingRate;

        return $this;
    }

    /**
     * @return Collection|SiteMaterial[]
     */
    public function getSiteMaterials(): Collection
    {
        return $this->siteMaterials;
    }

    public function addSiteMaterial(SiteMaterial $siteMaterial): self
    {
        if (!$this->siteMaterials->contains($siteMaterial)) {
            $this->siteMaterials[] = $siteMaterial;
            $siteMaterial->setSite($this);
        }

        return $this;
    }

    public function removeSiteMaterial(SiteMaterial $siteMaterial): self
    {
        if ($this->siteMaterials->contains($siteMaterial)) {
            $this->siteMaterials->removeElement($siteMaterial);
            // set the owning side to null (unless already changed)
            if ($siteMaterial->getSite() === $this) {
                $siteMaterial->setSite(null);
            }
        }

        return $this;
    }

    public function getEstimatedFinishDate()
    {
        return $this->estimatedFinishDate;
    }

    public function setEstimatedFinishDate($estimatedFinishDate)
    {
        $this->estimatedFinishDate = $estimatedFinishDate;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getLabel(): ?Label
    {
        return $this->label;
    }

    public function setLabel(?Label $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
