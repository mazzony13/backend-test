<?php

namespace App\Interfaces;

//interface for procuct repository
interface UserTypeRepositoryInterface
{
    public function getAllTypes();  //listing all Types
    public function getType(string $uuid); //get Type by UUID
    public function deleteType(string $uuid);  //delete Type
    public function createType(array $data); //create new Type
    public function updateType(string $uuid, array $newData); // update existing Type
}
