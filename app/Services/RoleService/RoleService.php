<?php
namespace App\Services\RoleService;
interface RoleService
{
    public function getAllRoles();

    public function addRole($data);

    public function findRoleById($id);

    public function updateRole($data, $id);

    public function deleteRole($id);

    public function getAllPermissionByRole($roleId);
}
