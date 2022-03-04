<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase {
    
    public function testApiHomePage(): void
    {
        $client = static::createClient();
        // Request a specific page
        $client->jsonRequest('GET', '/');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals(['message' => "Hello everybody!"], $responseData);
    }
}