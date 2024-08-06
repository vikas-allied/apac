<?php
namespace App\Services\PermissionService;

use App\Models\Permission;

class PermissionServiceImpl implements PermissionService
{
    public function getAllPermissions()
    {
        return (new Permission())->getAllPermission();
    }
}
