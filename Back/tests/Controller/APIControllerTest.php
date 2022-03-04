<?php

namespace App\Tests\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class APIControllerTest extends WebTestCase {

    public function testApiHome(): void
    {
        $client = static::createClient();
        // Request a specific page
        $client->jsonRequest('GET', '/api/');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals(['message' => "Hello world"], $responseData);
    }

    public function testApiProductsList(): void
    {
        $client = static::createClient();
        // Request a specific page
        $client->jsonRequest('GET', '/api/products');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals(20, count($responseData));
    }

    public function testApiGetOneProduct(): void
    {
        $product = [
            "id" => 16,
            "name" => "Amish Cyborg",
            "image" => "https://rickandmortyapi.com/api/character/avatar/16.jpeg",
            "price" => "10",
            "quantity" => 20
        ];

        $client = static::createClient();
        // Request a specific page
        $client->jsonRequest('GET', '/api/products/16');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals($product, $responseData);
    }

    // test product.quantity=0
    public function testApiNotAddProductsToCart(): void
    {
        $client = static::createClient();
        $client->jsonRequest('POST', '/api/cart/1', [
                'quantity' => '2',
            ]);
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals(["error" => "Too many sorry"], $responseData);
    }

    // test product.quantity>0
    public function testApiAddProductsToCart(): void
    {
        $product = [
            "id" => 16,
            "name" => "Amish Cyborg",
            "image" => "https://rickandmortyapi.com/api/character/avatar/16.jpeg",
            "price" => "10",
            "quantity" => 20
        ];

        $client = static::createClient();
        $client->jsonRequest('POST', '/api/cart/16', [
                'quantity' => '2',
            ]);
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        //dump($responseData["products"]);die;
        $this->assertEquals($product, $responseData["products"][0]);
    }
    
    public function testApiCart(): void
    {
        $product = [
            "id" => 16,
            "name" => "Amish Cyborg",
            "image" => "https://rickandmortyapi.com/api/character/avatar/16.jpeg",
            "price" => "10",
            "quantity" => 20
        ];
        $client = static::createClient();
        // Request a specific page
        $client->jsonRequest('GET', '/api/cart');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        //dump($responseData[0]['products'][0]);die;
        $this->assertEquals($product, $responseData[0]['products'][0]);
    }
    
    public function testApiDeleteProductFromCart(): void
    {
        $client = static::createClient();
        // Request a specific page
        $client->jsonRequest('DELETE', '/api/cart/16');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        //dump($responseData["products"]);die;
        $this->assertEquals([], $responseData['products']);
    }
}