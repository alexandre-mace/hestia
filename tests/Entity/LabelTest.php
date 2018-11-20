<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20/11/18
 * Time: 21:03
 */

namespace App\Tests\Entity;


use App\Entity\Label;
use App\Entity\Site;
use PHPUnit\Framework\TestCase;

class LabelTest extends TestCase
{
    public function testEntity()
    {
        $label = new Label();
        $label->setGrade('test');

        $this->assertEquals('test', $label->getGrade());
        $this->assertNull($label->getId());
    }
    public function testEntityRelations()
    {
        $label = new Label();
        $site = new Site();
        $label->addSite($site);
        $this->assertEquals($site, $label->getSites()[0]);
        $label->removeSite($site);
        $this->assertArrayNotHasKey(0, $label->getSites());
    }
}