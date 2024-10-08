<?php

namespace App\Http\Controllers\Api\v1\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ProductResource;
use App\Interfaces\ProductRepositoryInterface; // get product repository

class ShowController extends Controller
{

     //initiate product repository
     public function __construct(ProductRepositoryInterface $productRepository)
     {
         $this->productRepository = $productRepository;
     }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($uuid)
    {
        try{
            $product  = $this->productRepository->getProduct($uuid); // get returned product from repository

            if(!$product)
                return response()->json([
                    'message' => 'Product Not Found'
                ], 404);

            return response()->json([
                'data' =>new ProductResource($product),

            ]);

        }catch(\Exception $e){
            return response()->json([
                'message' => 'Error Retrieving product'
            ], 500);
        }
    }
}
