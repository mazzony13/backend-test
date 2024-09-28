<?php

namespace App\Http\Controllers\Api\v1\Product;

use App\Exceptions\api\LookupNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\LookupResource;
use App\Models\Lookup;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,$id)
    {
        //
        $lookup = Lookup::find($id);

        if($lookup){
            return $this->sendJson(new LookupResource($lookup));
        }
        throw new LookupNotFoundException();
    }
}
