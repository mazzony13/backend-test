<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers();  //listing all users
    public function getUser(string $uuid);  //get user by UUID
    public function deleteUser(string $uuid); //delete user
    public function createUser(array $data); //create new user
    public function updateUser(string $uuid, array $newData); // update existing user
}
