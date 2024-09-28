<?php

namespace App\Http\Controllers\Api\v1\UserType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserTypeRequest;
use App\Interfaces\UserTypeRepositoryInterface; // get userType repository

class CreateController extends Controller
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
    public function __invoke(UserTypeRequest $request)
    {

        try{
            $userType  = $this->userTypeRepository->createUserType($request->all()); // get returned userType from repository
            return response()->json([
                'message'       => 'UserType Created successfully',
            ]);

        }catch(\Exception $e){
            return response()->json([
                'message' => 'Error Occured on creating userType'
            ], 500);
        }
    }
}
