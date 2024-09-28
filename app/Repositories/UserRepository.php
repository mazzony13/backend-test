<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers($data) //return paginated user with default 10
    {
        return  User::paginate($data['per_page'] ?? 10);
    }

    public function getUser(string $uuid) // get user by checking on his uuid
    {
        return User::where('uuid',$uuid)->first() ?? null;
    }

    public function deleteUser(string $uuid)
    {
        //check if admin will delete him self and he is the last admin so he couldn't delete his account
        if(auth()->user()->hasRole('super-admin'))
        {
            $admins = User::role('super-admin')->count();

            if($admins ==1)
                return 'last-admin';
        }

        $user = User::where('uuid',$uuid)->first(); //get user by uuid
        if(!$user)
            return false;

       $user->delete();
       return true;
    }

    public function createUser(array $data)
    {
        $user = User::create($data); // create user
        $user->syncRoles($data['role']); // sync user role

        //check if user had uploaded an image as avatar attach it to user model using spatie media library
        if(isset($data['avatar']))
            $this->save_image($user,$data['avatar']);
        return $user;
    }

    public function updateUser(string $uuid, array $data)
    {
        $user = User::where('uuid',$uuid)->first(); //get user by uuid

        if(!$user)
            return false;

        if(isset($data['avatar'])) // update user image
            $this->saveImage($user,$data['avatar']);

        return $user->update($data);
    }

    public function saveImage($user,$image) //function to save image on update or create
    {
        if($user)
        {
            $user->clearMediaCollection('avatar'); //remove old image if exists
            $user->addMedia($image)->toMediaCollection('avatar');
        }
    }
}
