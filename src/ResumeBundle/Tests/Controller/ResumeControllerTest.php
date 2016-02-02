<?php

namespace ResumeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ResumeControllerTest extends WebTestCase
{
    public function testFlat()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/flat');
    }

}
