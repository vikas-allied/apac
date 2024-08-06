<?php
namespace App\Services\RoleService;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleServiceImpl implements RoleService
{
    private $role;
    public function __construct()
    {
        $this->role = New Role();
    }
    public function getAllRoles()
    {
        return $this->role->getAllRoles();
    }


    public function addRole($data)
    {
        return $this->role->addRole($data);
    }

    public function findRoleById($id)
    {
        return $this->role->findRoleById($id);
    }

    public function updateRole($data, $id)
    {
        return $this->role->updateRole($data, $id);
    }

    public function deleteRole($id)
    {
        return $this->role->deleteRole($id);
    }

    public function getAllPermissionByRole($roleId)
    {
        return DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $roleId)
            ->pluck( 'role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
    }
}
