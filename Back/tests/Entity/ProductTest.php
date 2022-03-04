<?php 

namespace App\tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {

    public function testName ()
    {
        $product = new Product();
        $name = "Name1";
        
        $product->setName($name);
        $this->assertEquals("Name1", $product->getName());
    }

    public function testImage ()
    {
        $product = new Product();
        $image = "https://rickandmortyapi.com/api/character/avatar/14.jpeg";
        
        $product->setImage($image);
        $this->assertEquals("https://rickandmortyapi.com/api/character/avatar/14.jpeg", $product->getImage());
    }

    public function testPrice ()
    {
        $product = new Product();
        $price = 1;
        
        $product->setPrice($price);
        $this->assertEquals(1, $product->getPrice());
    }

    public function testQuantity ()
    {
        $product = new Product();
        $quantity = "20";
        
        $product->setQuantity($quantity);
        $this->assertEquals("20", $product->getQuantity());
    }

}