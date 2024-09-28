<?php

namespace App\Http\Controllers\Api\v1\UserType;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\UserTypeResource;
use App\Interfaces\UserTypeRepositoryInterface; // get userType repository

class ShowController extends Controller
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
    public function __invoke($id)
    {
        try{
            $userType  = $this->userTypeRepository->getUserType($id); // get returned userType from repository

            if(!$userType)
                return response()->json([
                    'message' => 'UserType Not Found'
                ], 404);

            return response()->json([
                'data' =>new UserTypeResource($userType),

            ]);

        }catch(\Exception $e){
            return response()->json([
                'message' => 'Error Retrieving userType'
            ], 500);
        }
    }
}
