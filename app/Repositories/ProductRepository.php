<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

// class where repository interface implementation added
class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts()
    {
        return Product::where('is_active')->get();
    }

    public function getProduct($uuid)
    {
        return Product::where('uuid',$uuid)->first() ?? null;
    }

    public function deleteProduct($uuid)
    {
        Product::where('uuid',$uuid)->delete();
    }

    public function createProduct(array $data)
    {
        $product = Product::create($data);//create product

        if(isset($data['image']))
        $this->saveImage($product,$data['image']);// attach image to product

        //set product prices
        foreach($data['price'] as $key=>$value)
        {
            $product->set_price($key,$value);
        }

        return $product;
    }

    public function updateProduct($uuid, array $data)
    {
        $product = Product::where('uuid',$uuid)->first(); //get product by uuid

        if(!$product)
            return false;

        if(isset($data['image'])) // update product image
        $this->saveImage($product,$data['image']);

        $product->prices()->delete(); // delete old prices

        //set product prices
        foreach($data['price'] as $key=>$value)
        {
            $product->set_price($key,$value);
        }

        return $product->update($data);
    }

    public function saveImage($product,$image) //function to save image on update or create
    {
        if($product)
        {
            $product->clearMediaCollection('product-image'); //remove old image if exists
            $product->addMedia($image)->toMediaCollection('product-image');
        }

    }

}
