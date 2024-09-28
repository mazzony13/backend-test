<?php

namespace App\Http\Controllers\Api\v1\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductRequest;
use App\Repositories\ProductRepository; // get product repository

class CreateController extends Controller
{

    //initiate product repository
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ProductRequest $request)
    {

        try{
            $product  = $this->productRepository->createProduct($request->all()); // get returned product from repository
            return response()->json([
                'message'       => 'Product Created successfully',
            ]);

        }catch(\Exception $e){
            return response()->json([
                'message' => 'Error Occured on creating product'
            ], 500);
        }
    }
}
