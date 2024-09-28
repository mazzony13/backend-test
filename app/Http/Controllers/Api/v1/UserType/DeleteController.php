<?php

namespace App\Http\Controllers\Api\v1\UserType;

use App\Http\Controllers\Controller;
use App\Interfaces\UserTypeRepositoryInterface; // get userType repository

class DeleteController extends Controller
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
            $userType  = $this->userTypeRepository->deleteUserType($id); // get returned userType from repository

            if(!$userType)
                return response()->json([
                    'message' => 'UserType Not Found'
                ], 404);

            return response()->json([
                'message'       => 'UserType deleted successfully',
            ]);

        }catch(\Exception $e){
            return response()->json([
                'message' => 'Error Occured on updating userType'
            ], 500);
        }
    }
}
