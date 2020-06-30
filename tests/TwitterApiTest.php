<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class TwitterApiTest
 * @package App\Tests
 */
class TwitterApiTest extends WebTestCase
{

    public function testResponseOk()
    {
        $client = static::createClient();
        $client->request('GET', '/api/twitter/tweets/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
