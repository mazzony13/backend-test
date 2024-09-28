<?php

namespace App\Http\Controllers\Api\v1\Product;

use App\Http\Controllers\Controller;
use App\Interfaces\ProductRepositoryInterface; // get product repository

class DeleteController extends Controller
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
            $product  = $this->productRepository->deleteProduct($uuid); // get returned product from repository

            if(!$product)
                return response()->json([
                    'message' => 'Product Not Found'
                ], 404);

            return response()->json([
                'message'       => 'Product deleted successfully',
            ]);

        }catch(\Exception $e){
            return response()->json([
                'message' => 'Error Occured on updating product'
            ], 500);
        }
    }
}
