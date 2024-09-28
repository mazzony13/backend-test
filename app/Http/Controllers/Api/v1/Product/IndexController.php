<?php

namespace App\Http\Controllers\Api\v1\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LookupRequest;
use App\Http\Resources\v1\LookupResource;
use App\Models\Lookup;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LookupRequest $request)
    {
        //
        return $this->sendJson(LookupResource::collection(Lookup::key($request->key)->get()));

    }
}
