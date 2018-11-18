<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompanyChiefRepository")
 */
class CompanyChief extends User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $company;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SiteManager", mappedBy="director")
     */
    protected $siteManagers;

    public function __construct()
    {
        $this->siteManagers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection|SiteManager[]
     */
    public function getSiteManagers(): Collection
    {
        return $this->siteManagers;
    }

    public function addSiteManager(SiteManager $siteManager): self
    {
        if (!$this->siteManagers->contains($siteManager)) {
            $this->siteManagers[] = $siteManager;
            $siteManager->setDirector($this);
        }

        return $this;
    }

    public function removeSiteManager(SiteManager $siteManager): self
    {
        if ($this->siteManagers->contains($siteManager)) {
            $this->siteManagers->removeElement($siteManager);
            // set the owning side to null (unless already changed)
            if ($siteManager->getDirector() === $this) {
                $siteManager->setDirector(null);
            }
        }

        return $this;
    }
}
