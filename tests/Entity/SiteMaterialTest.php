<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20/11/18
 * Time: 21:08
 */

namespace App\Tests\Entity;


use App\Entity\Material;
use App\Entity\Site;
use App\Entity\SiteMaterial;
use PHPUnit\Framework\TestCase;

class SiteMaterialTest extends TestCase
{
    public function testEntity()
    {
        $siteMaterial = new SiteMaterial;
        $siteMaterial->setQuantity(1);

        $this->assertEquals(1, $siteMaterial->getQuantity());
        $this->assertNull($siteMaterial->getId());
    }

    public function testEntityRelations()
    {
        $siteMaterial = new SiteMaterial();
        $material = new Material();
        $siteMaterial->setMaterial($material);
        $this->assertEquals($material, $material, $siteMaterial->getMaterial());

        $siteMaterial = new SiteMaterial();
        $site = new Site();
        $siteMaterial->setSite($site);
        $this->assertEquals($site, $siteMaterial->getSite());
    }
}