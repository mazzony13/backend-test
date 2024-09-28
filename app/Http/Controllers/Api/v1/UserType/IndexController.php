<?php

namespace App\Http\Controllers\Api\v1\UserType;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $user_types = array();
        $cases=\App\Enums\UserType::cases();

        foreach($cases as $key=>$case){
            $user_types[$key]['name']= $case->name;
            $user_types[$key]['value']= $case->value;
        }
        return response()->json([
            'data' => $user_types,
        ]);
    }
}
