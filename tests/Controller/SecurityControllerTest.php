<?php

// Tests/Controller/SecurityControllerTest.php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class SecurityControllerTest extends WebTestCase
{

    public function testLogin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');
        $this->assertTrue($client->getResponse()->isSuccessful());

        $testEmail = 'testLogin' . rand() . '@test.com';
        if ($client->getResponse()->isSuccessful()) {
            $form = $crawler->selectButton('S\'inscrire')->form();
            $form['site_manager[firstname]'] = 'test';
            $form['site_manager[lastname]'] = 'test';
            $form['site_manager[company]'] = 'test';
            $form['site_manager[email]'] = $testEmail;
            $form['site_manager[plainPassword][first]'] = 'test';
            $form['site_manager[plainPassword][second]'] = 'test';
            $client->submit($form);

            $this->assertTrue($client->getResponse()->isRedirection());
        }
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form();
        $crawler = $client
            ->submit($form,
                array(
                    'email' => $testEmail,
                    'password' => 'test',
                )
        );

        $this->assertTrue($client->getResponse()->isRedirection());       
        $crawler = $client->followRedirect();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testLogout()
    {
        $client = self::createClient(array(), array(
            'PHP_AUTH_USER' => 'test@test.com',
            'PHP_AUTH_PW' => 'test'
        ));
        $client->request('GET', '/logout');
        $this->assertTrue($client->getResponse()->isRedirection());
    }
}