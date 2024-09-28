<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface; // get user repository

class DeleteController extends Controller
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
    public function __invoke($uuid)
    {
        try{
            //check if user is not admin and need to delete other account
            if(auth()->user()->hasRole('user') && auth()->user()->uuid !=$uuid )
            {
                return response()->json([
                    'message' => 'You are not authorized to delete other users'
                ], 403);
            }

            $user  = $this->userRepository->deleteUser($uuid); // get returned user from repository

            if(!$user) //case no user found with uuid
            {
                return response()->json([
                    'message' => 'User Not Found'
                ], 404);
            }else{

                if($user ==='last-admin')//case to handle last admin
                {
                    return response()->json([
                        'message' => "You Can't delete the last admin on the application"
                    ], 403);
                }
                //normal case if user is deleting him self or admin deleting normal user
                return response()->json([
                    'message'       => 'User deleted successfully',
                ]);
            }

        }catch(\Exception $e){
            return response()->json([
                'message' => 'Error Occured on updating user'
            ], 500);
        }
    }
}
