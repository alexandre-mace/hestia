<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20/11/18
 * Time: 21:06
 */

namespace App\Tests\Entity;


use App\Entity\Material;
use App\Entity\SiteMaterialsExample;
use PHPUnit\Framework\TestCase;

class MaterialTest extends TestCase
{
    public function testEntity()
    {
        $material = new Material();
        $material->setName('test');
        $material->setIsRecycled(true);

        $this->assertEquals('test', $material->getName());
        $this->assertEquals(true, $material->getIsRecycled());
        $this->assertNull($material->getId());
    }

    public function testEntityRelations()
    {
        $material = new Material();
        $siteMaterialsExample = new SiteMaterialsExample();
        $material->addSiteMaterialsExample($siteMaterialsExample);
        $this->assertEquals($siteMaterialsExample, $material->getSiteMaterialsExample()[0]);
        $material->removeSiteMaterialsExample($siteMaterialsExample);
        $this->assertArrayNotHasKey(0, $material->getSiteMaterialsExample());
    }

    public function testToString()
    {
        $material = new Material();
        $material->setName('test');
        $this->assertEquals('test', $material->__toString());
    }
}