<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;

class RegisterController extends Controller
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {
        //add role as user as this is a registered user won't be an admin
        $request->merge(["role"=>"user"]);

        //try use user repository to create new user then if it succeeds will create a token for registered user to give him access
        try{
            $user  = $this->userRepository->createUser($request->all()); // get returned user from repository
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message'       => 'You had been registered successfully',
                'access_token'  => $token,
                'token_type'    => 'Bearer'
            ]);

        }catch(\Exception $e){
            dd($e);
            return response()->json([
                'message' => 'Error Occured on register please try again'
            ], 500);
        }
    }

}
