<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestShowUserTest extends WebTestCase
{
    public function testResponseOk()
    {
        $client = static::createClient();
        $client->request('GET', '/api/user/profile/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
