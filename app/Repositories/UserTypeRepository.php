<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\UserType;

class UserTypeRepository implements UserRepositoryInterface
{
    public function getAllTypes()
    {
        return UserType::where('is_active')->get();
    }

    public function getType(string $uuid)
    {
        return UserType::where('uuid',$uuid)->first() ?? null;
    }

    public function deleteType(string $uuid)
    {
        UserType::where('uuid',$uuid)->delete();
    }

    public function createType(array $data)
    {
        return UserType::create($data);
    }

    public function updateType(string $uuid, array $newData)
    {
        return UserType::where('uuid',$uuid)->update($newData);
    }
}
