<?php

namespace App\Tests\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

dump($_ENV['APP_SECRET'] ?? '(not set)');
dump($_SERVER['APP_SECRET'] ?? '(not set)');

class AdminAccessTest extends WebTestCase
{
    public function testAdminPageIsRestricted()
    {
        $client = static::createClient();
        $client->request('GET', '/fledgless');

        $this->assertResponseRedirects('/login');
    }
}