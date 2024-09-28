<?php

namespace App\Interfaces;

//interface for procuct repository
interface UserTypeRepositoryInterface
{
    public function getAllUserTypes();  //listing all Types
    public function getUserType(int $id); //get Type by UUID
    public function deleteUserType(int $id);  //delete Type
    public function createUserType(array $data); //create new Type
    public function updateUserType(int $id, array $newData); // update existing Type
}
