<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 22/11/18
 * Time: 22:52
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class SiteControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'test@test.com',
            'PHP_AUTH_PW' => 'test'
        ));
        $client->request('GET', '/sites');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testSitePath()
    {
        $client = self::createClient(array(), array(
            'PHP_AUTH_USER' => 'test@test.com',
            'PHP_AUTH_PW' => 'test'
        ));
        $crawler = $client->request('GET', '/site/choose-type');
        $this->assertTrue($client->getResponse()->isSuccessful());

        if ($client->getResponse()->isSuccessful()) {
            $form = $crawler->filter('form')->form();
            $form['site_type[choice]'] = 'construction';
            $client->submit($form);

            $this->assertTrue($client->getResponse()->isRedirection());

            $crawler = $client->followRedirect();
        }
        $siteName = 'test' .rand();
        $form = $crawler->selectButton('Enregistrer')->form();
        $form['site_general_information[name]'] = $siteName;
        $form['site_general_information[street]'] = 'test';
        $form['site_general_information[postalCode]'] = 00000;
        $form['site_general_information[city]'] = 'test';
        $form['site_general_information[estimatedFinishDate]'] = '2020-01-01';
        $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirection());

        $materialsData = [
            'site_materials' => [
                0 => [
                    'material' => 'Fer',
                    'quantity' => 1
                ],
                1 => [
                    'material' => 'Bois',
                    'quantity' => 1
            ]
                ]
        ];

        $client->request('POST', '/site/' .$siteName. '/add-materials', $materialsData);
        echo $client->getResponse()->getContent();die;
        $this->assertTrue($client->getResponse()->isRedirection());
    }
}