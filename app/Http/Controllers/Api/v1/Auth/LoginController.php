<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request)
    {
        //get email and password from request
        $credentials = $request->only('email', 'password');

        //check user credentials
        if (! Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }

        //if credentials are right generate bearer user token and return it to user
        $user   = User::where('email', $request->email)->firstOrFail();
        $token  = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'       => 'Logged in successfully',
            'access_token'  => $token,
            'token_type'    => 'Bearer'
        ]);
    }

}
