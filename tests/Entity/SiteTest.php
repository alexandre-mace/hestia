<?php

namespace App\Tests\Entity;

use App\Entity\Label;
use App\Entity\SiteMaterial;
use PHPUnit\Framework\TestCase;
use App\Entity\Site;
use App\Entity\SiteManager;

class SiteTest extends TestCase
{
    public function testEntity()
    {
        $site = new Site();
        $site->setName('test name');
        $site->setRecyclingRate(80);
        $estimatedFinishDate = new \DateTime();
        $site->setEstimatedFinishDate($estimatedFinishDate);
        $site->setType('construction');
        $site->setStreet('test street');
        $site->setPostalCode(11111);
        $site->setCity('Tours');
        $datetime = new \Datetime;
        $site->setCreatedAt($datetime);
        $updatedAt = new \DateTime();
        $site->setUpdatedAt($updatedAt);
        $this->assertEquals('test name', $site->getName());
        $this->assertEquals(80, $site->getRecyclingRate());
        $this->assertEquals($estimatedFinishDate, $site->getEstimatedFinishDate());
        $this->assertEquals('construction', $site->getType());
        $this->assertEquals('test street', $site->getStreet());
        $this->assertEquals('construction', $site->getType());
        $this->assertEquals(11111, $site->getPostalCode());
        $this->assertEquals('Tours', $site->getCity());
        $this->assertEquals($datetime, $site->getCreatedAt());
        $this->assertEquals($updatedAt, $site->getUpdatedAt());
        $this->assertNull($site->getId());
    }

    public function testEntityRelations()
    {
        $manager = new SiteManager();
        $label = new Label();
        $site = new Site();
        
        $site->setManager($manager);
        $site->setLabel($label);
        $this->assertEquals($manager, $site->getManager());
        $this->assertEquals($label, $site->getLabel());

        $site = new Site();
        $siteMaterial = new SiteMaterial();
        $site->addSiteMaterial($siteMaterial);
        $this->assertEquals($siteMaterial, $site->getSiteMaterials()[0]);
        $site->removeSiteMaterial($siteMaterial);
        $this->assertArrayNotHasKey(0, $site->getSiteMaterials());
    }
}
