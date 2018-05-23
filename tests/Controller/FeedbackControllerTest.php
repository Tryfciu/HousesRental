<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FeedbackControllerTest extends WebTestCase
{
    public function testSendingFeedbackWithoutContent()
    {
        $client = $this->createClient();

        $client->request('POST', '/contact/sendFeedback');

        $this->assertEquals(500, $client->getResponse()->getStatusCode());
    }

    public function testGettingOffersPage()
    {
        $client = $this->createClient();

        $client->request('GET', '/offers');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}