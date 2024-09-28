<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::where('is_active')->get();
    }

    public function getUser(string $uuid)
    {
        return User::where('uuid',$uuid)->first() ?? null;
    }

    public function deleteUser(string $uuid)
    {
        User::where('uuid',$uuid)->delete();
    }

    public function createUser(array $data)
    {
        $user = User::create($data); // create user
        $user->syncRoles($data['role']); // sync user role

        //check if user had uploaded an image as avatar attach it to user model using spatie media library
        if(isset($data['avatar']))
        {
            $user->addMedia($data['avatar'])->toMediaCollection('avatar');
        }
        return $user;
    }

    public function updateUser(string $uuid, array $newData)
    {
        return User::where('uuid',$uuid)->update($newData);
    }
}
