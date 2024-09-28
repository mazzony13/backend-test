<?php

namespace App\Http\Controllers\Api\v1\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ProductResource;
use App\Interfaces\ProductRepositoryInterface; // get product repository
use Illuminate\Http\Request;

class IndexController extends Controller
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
    public function __invoke(Request $request)
    {
        try{
            $products  = $this->productRepository->getAllProducts($request->all()); // get returned products from repository
            return response()->json(
                ProductResource::collection($products)->response()->getData(),
            );
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Error Retrieving products'
            ], 500);
        }

    }
}
