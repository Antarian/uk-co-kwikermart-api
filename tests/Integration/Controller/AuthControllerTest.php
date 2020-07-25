<?php
namespace App\Tests\Integration\Controller;

use App\Auth\ORM\Entity\User;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthControllerTest extends WebTestCase
{
    private $client;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testRegister()
    {
        $content = json_encode([
            'email' => 'test@test.devel',
            'password' => 'Abcd-1234!',
        ]);
        $this->client->request('POST', '/register', [], [], [], $content);

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
    }

    public function testLogin()
    {
        $content = json_encode([
            'email' => 'testuser1@test.devel',
            'password' => 'test-Password1',
        ]);
        $this->client->request('POST', '/login_check', [], [], ['CONTENT_TYPE' => 'application/json'], $content);

        $this->assertContains("token", $this->client->getResponse()->getContent());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}
