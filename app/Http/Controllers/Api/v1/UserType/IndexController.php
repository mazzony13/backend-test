<?php

namespace App\Http\Controllers\Api\v1\UserType;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\UserTypeResource;
use App\Interfaces\UserTypeRepositoryInterface; // get userType repository
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //initiate userType repository
    public function __construct(UserTypeRepositoryInterface $userTypeRepository)
    {
        $this->userTypeRepository = $userTypeRepository;
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
            $userTypes  = $this->userTypeRepository->getAllUserTypes($request->all()); // get returned userTypes from repository
            return response()->json(
                UserTypeResource::collection($userTypes)->response()->getData(),
            );
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Error Retrieving userTypes'
            ], 500);
        }

    }
}
