<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SiteManagerRepository")
 */
class SiteManager extends User
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $company;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyChief", inversedBy="siteManagers")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $director;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Site", mappedBy="manager")
     */
    protected $sites;

    public function __construct()
    {
        $this->sites = new ArrayCollection();
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

    public function getDirector(): ?CompanyChief
    {
        return $this->director;
    }

    public function setDirector(?CompanyChief $director): self
    {
        $this->director = $director;

        return $this;
    }

    /**
     * @return Collection|Site[]
     */
    public function getSites(): Collection
    {
        return $this->sites;
    }

    public function addSite(Site $site): self
    {
        if (!$this->sites->contains($site)) {
            $this->sites[] = $site;
            $site->setManager($this);
        }

        return $this;
    }

    public function removeSite(Site $site): self
    {
        if ($this->sites->contains($site)) {
            $this->sites->removeElement($site);
            // set the owning side to null (unless already changed)
            if ($site->getManager() === $this) {
                $site->setManager(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->firstname;
    }
}
