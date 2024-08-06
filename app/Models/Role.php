<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        $attributes['guard_name'] = 'web';
        parent::__construct($attributes);
    }


    /**
     * Service methods for CRUD
     */


    public function getAllRoles()
    {
        return $this->select('id', 'name')->get();
    }

    public function addRole($data)
    {
        return $this->create($data);
    }

    public function findRoleById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function updateRole($data, $id)
    {
        return $this->where('id', $id)->update($data);
    }

    public function deleteRole($id)
    {
        return $this->find($id)->delete();
    }
}
