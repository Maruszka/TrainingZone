<?php

namespace TrainingZoneBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrainingControllerTest extends WebTestCase
{
    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/add');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/delete');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/edit');
    }

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/show');
    }

    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/list');
    }

    public function testByname()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/byName');
    }

    public function testBydate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/byDate');
    }

    public function testBetweendate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/betweenDate');
    }

}
