<?php

namespace Caxy\Bundle\WebhookBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WebhookControllerTest extends WebTestCase
{
    public function testHandle()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/webhook');
        $this->assertEquals(200, $client->getInternalResponse()->getStatus());

        $crawler = $client->request('GET', '/webhook');
        $this->assertTrue($client->getInternalResponse()->getStatus() >= 400 && $client->getInternalResponse()->getStatus() < 500, 'Access denied');
    }
}
