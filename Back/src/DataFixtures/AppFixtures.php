<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Product;
use App\Service\RickAndMortyApiService;

class AppFixtures extends Fixture
{
    private $prices = ["8", "9,99", "10", "15", "13,50"];
    private $quantities = [0,2,5,20,30,70];
    private RickAndMortyApiService $rickAndMortyApiService;

    public function __construct(RickAndMortyApiService $rickAndMortyApiService)
    {
        $this->rickAndMortyApiService = $rickAndMortyApiService;
    }

    public function load(ObjectManager $manager): void
    {
        $data = $this->rickAndMortyApiService->loadApi();
        foreach($data as $model) {
            $product = new Product();
            $product->setName($model->getName());
            $product->setPrice($this->prices[array_rand($this->prices, 1)]);
            $product->setQuantity($this->quantities[array_rand($this->quantities, 1)]);
            $product->setImage($model->getImage());
            $manager->persist($product);
        }
        $manager->flush();
    }
}
