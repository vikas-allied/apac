<?php
namespace App\Services\AdminUserService;
use App\Models\User;

class AdminUserServiceImpl implements AdminUserService
{
    private $admin;
    public function __construct()
    {
        $this->admin = new User();
    }
    public function getUserByEmail($email)
    {
        return $this->admin->getUserByEmail($email);
    }

    public function updateUser($data, $id)
    {
        return $this->admin->updateUser($data, $id);
    }

    public function getUserByTokenAndEmail($token, $email)
    {
        return $this->admin->getUserByTokenAndEmail($token, $email);
    }

    public function getAllUsers()
    {
        return $this->admin->getAllUsers();
    }

    public function addUser($data)
    {
        return $this->admin->addUser($data);
    }

    public function findUserById($id)
    {
        return $this->admin->findUserById($id);
    }

    public function deleteUser($id)
    {
        return $this->admin->deleteUser($id);
    }

}
