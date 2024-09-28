<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Interfaces\UserRepositoryInterface; // get user repository

class CreateController extends Controller
{

    //initiate user repository
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UserRequest $request)
    {

        try{
            $user  = $this->userRepository->createUser($request->all()); // get returned user from repository
            return response()->json([
                'message'       => 'User Created successfully',
            ]);

        }catch(\Exception $e){
            //dd($e);
            return response()->json([
                'message' => 'Error Occured on creating user'
            ], 500);
        }
    }
}
