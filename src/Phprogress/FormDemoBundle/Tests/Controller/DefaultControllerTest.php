<?php

namespace Phprogress\FormDemoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/hello/Fabien');

        $this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
    }

    public function testUebung2()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/uebung1/IUGiygsf');

        $this->assertTrue($crawler->filter('html:contains("Diesen String haben wir bekommen:")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("IUGiygsf")')->count() > 0);
    }
}
