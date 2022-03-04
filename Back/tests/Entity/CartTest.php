<?php 

namespace App\tests\Entity;

use App\Entity\Cart;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase {

    public function testProducts ()
    {
        $cart = new Cart();
        $product = new Product();
        
        $this->assertNotNull($cart->getProducts()->contains($product));
    }

}