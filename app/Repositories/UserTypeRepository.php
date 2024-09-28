<?php

namespace App\Repositories;

use App\Interfaces\UserTypeRepositoryInterface;
use App\Models\UserType;

class UserTypeRepository implements UserTypeRepositoryInterface
{
    public function getAllUserTypes()
    {
        return UserType::get();
    }

    public function getUserType(int $id)
    {
        return UserType::find($id) ?? null;
    }

    public function deleteUserType(int $id)
    {
        $user_type = UserType::find($id);

        if(!$user_type)
            return false;

        $user_type->delete();
        return true;
    }

    public function createUserType(array $data)
    {
        return UserType::create($data);
    }

    public function updateUserType(int $id, array $newData)
    {
        $user_type = UserType::find($id);

        if(!$user_type)
            return false;

        return UserType::findOrFail($id)->update($newData);
    }
}
