<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FrontControllerTest extends WebTestCase
{

    public function testOnBoarding()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/on-boarding');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Intégrer votre entreprise dans une démarche environnemental inédite (economie circulaire).', $crawler->filter('p')->first()->text());
    }
    public function testHome()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $this->assertTrue($client->getResponse()->isRedirection());
    }
}
