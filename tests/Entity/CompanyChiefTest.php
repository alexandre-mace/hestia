<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20/11/18
 * Time: 21:01
 */

namespace App\Tests\Entity;


use App\Entity\CompanyChief;
use App\Entity\SiteManager;
use PHPUnit\Framework\TestCase;

class CompanyChiefTest extends TestCase
{
    public function testEntity()
    {
        $companyChief = new CompanyChief();
        $companyChief->setUsername('Username test');
        $companyChief->setPassword('Userpassword test');
        $companyChief->setEmail('$companyChieftest@test.com');
        $companyChief->setCompany('test');
        $companyChief->setRoles(['ROLE_USER']);

        $this->assertEquals('Username test', $companyChief->getUsername());
        $this->assertEquals('Userpassword test', $companyChief->getPassword());
        $this->assertEquals('$companyChieftest@test.com', $companyChief->getEmail());
        $this->assertEquals(true, in_array('ROLE_USER', $companyChief->getRoles()));
        $this->assertEquals('test', $companyChief->getCompany());
        $this->assertNull($companyChief->getId());
    }
    public function testEntityRelations()
    {
        $companyChief = new CompanyChief();
        $siteManager = new SiteManager();
        $companyChief->addSiteManager($siteManager);
        $this->assertEquals($siteManager, $companyChief->getSiteManagers()[0]);
        $companyChief->removeSiteManager($siteManager);
        $this->assertArrayNotHasKey(0, $companyChief->getSiteManagers());
    }
}