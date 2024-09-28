<?php

namespace App\Interfaces;

//interface for procuct repository
interface ProductRepositoryInterface
{
    public function getAllProducts();  //listing all products
    public function getProduct(string $uuid); //get product by UUID
    public function deleteProduct(string $uuid);  //delete product
    public function createProduct(array $data); //create new product
    public function updateProduct(string $uuid, array $newData); // update existing product
}
