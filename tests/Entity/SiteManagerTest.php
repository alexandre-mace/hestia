<?php

namespace App\Tests\Entity;

use App\Entity\Site;
use App\Entity\SiteManager;
use PHPUnit\Framework\TestCase;
use App\Entity\User;

class SiteManagerTest extends TestCase
{
    public function testEntity()
    {
        $siteManager = new SiteManager();
        $siteManager->setUsername('Username test');
        $siteManager->setPassword('Userpassword test');
        $siteManager->setEmail('$siteManagertest@test.com');
        $siteManager->setRoles(['ROLE_USER']);
        $siteManager->setPhoneNumber('test');

        $this->assertEquals('Username test', $siteManager->getUsername());
        $this->assertEquals('Userpassword test', $siteManager->getPassword());
        $this->assertEquals('$siteManagertest@test.com', $siteManager->getEmail());
        $this->assertEquals(true, in_array('ROLE_USER', $siteManager->getRoles()));
        $this->assertEquals('test', $siteManager->getPhoneNumber());
        $this->assertNull($siteManager->getId());
    }

    public function testEntityRelations()
    {
        $siteManager = new SiteManager();
        $site = new Site();
        $siteManager->addSite($site);
        $this->assertEquals($site, $siteManager->getSites()[0]);
        $siteManager->removeSite($site);
        $this->assertArrayNotHasKey(0, $siteManager->getSites());
    }
}
