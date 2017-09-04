<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainControllerTest extends WebTestCase
{
    public function testMain()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

}
