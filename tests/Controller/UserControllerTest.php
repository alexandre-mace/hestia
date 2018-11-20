<?php

// Tests/Controller/UserControllerTest.php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserControllerTest extends WebTestCase
{

    public function testDashboard()
    {
        $client = self::createClient(array(), array(
            'PHP_AUTH_USER' => 'test@test.com',
            'PHP_AUTH_PW' => 'test'
        ));
        $client->request('GET', '/sitemanager/dashboard');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}