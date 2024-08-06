<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory;


    /**
     * Service methods for CRUD
     */


    public function getAllPermission()
    {
        return $this->select('id', 'name')->get();
    }

}
