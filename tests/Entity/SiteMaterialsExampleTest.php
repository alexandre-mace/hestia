<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20/11/18
 * Time: 21:10
 */

namespace App\Tests\Entity;


use App\Entity\Material;
use App\Entity\SiteMaterialsExample;
use PHPUnit\Framework\TestCase;

class SiteMaterialsExampleTest extends TestCase
{
    public function testEntity()
    {
        $siteMaterialsExample = new SiteMaterialsExample();
        $siteMaterialsExample->setName('test');

        $this->assertEquals('test', $siteMaterialsExample->getName());
        $this->assertNull($siteMaterialsExample->getId());
    }
    public function testEntityRelations()
    {
        $siteMaterialsExample = new SiteMaterialsExample();
        $material = new Material();
        $siteMaterialsExample->addMaterial($material);
        $this->assertEquals($material, $material, $siteMaterialsExample->getMaterials()[0]);
        $siteMaterialsExample->removeMaterial($material);
        $this->assertArrayNotHasKey(0, $siteMaterialsExample->getMaterials());
    }
}