<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class TestShowUserTest
 * @package App\Tests
 */
class TestShowUserTest extends WebTestCase
{
    /**
     * Check response api get user profile
     */
    public function testResponseOk()
    {
        $client = static::createClient();
        $client->request('GET', '/api/portfolio/profile/Daenerys');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
