<?php
namespace App\Services\AdminUserService;
interface AdminUserService
{
    public function getUserByEmail($email);
    public function updateUser($data, $id);
    public function getUserByTokenAndEmail($token, $email);
    public function getAllUsers();
    public function addUser($data);
    public function findUserById($id);
    public function deleteUser($id);
}
