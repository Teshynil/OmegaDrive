<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testSubmit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/API/Submit');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/API/Delete');
    }

    public function testDrop()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/API/Drop');
    }

    public function testShare()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/API/Share');
    }

    public function testRecover()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/API/Recover');
    }

}
