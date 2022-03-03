<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\RickAndMortyGestion;
use App\Entity\Product;
use Exception;

#[Route('/api', name: 'api')]
class APIController extends AbstractController
{
    #[Route('/', name: 'api_home')]
    public function index(Request $request): Response
    {
        return $this->json(['message' => "Hello world"]);
    }

    #[Route('/products', name: 'api_products', methods: ["GET"])]
    public function products(Request $request, RickAndMortyGestion $rickAndMortyGestion): Response
    {
        return $this->json($rickAndMortyGestion->findAll());
    }

    #[Route('/products/{id}', name: 'api_product', methods: ["GET"])]
    public function productById(Request $request, Product $product): Response
    {
        return $this->json($product);
    }

    #[Route('/cart/{id}', name: 'api_add_product', methods: ["POST"])]
    public function addProductToCart(Request $request, RickAndMortyGestion $rickAndMortyGestion, Product $product): Response
    {
        try {
            $data = json_decode($request->getContent(), true);
            $quantity = intval($data['quantity']);
            $rickAndMortyGestion->addProductToCart($product, $quantity);
        }
        catch (\Exception $e) {
            return $this->json(["error" => "Too many sorry"]);
        }
    }

    #[Route('/cart/{id}', name: 'api_delete_product', methods: ["DELETE"])]
    public function deleteProductToCart(Request $request, RickAndMortyGestion $rickAndMortyGestion, Product $product)
    {
        $cart = $rickAndMortyGestion->deleteProductToCart($product);
    }

    
    #[Route('/cart', name: 'api_cart', methods: ["GET"])]
    public function cart(Request $request, RickAndMortyGestion $rickAndMortyGestion): Response
    {
        return $this->json($rickAndMortyGestion->findCart());
    }

}
