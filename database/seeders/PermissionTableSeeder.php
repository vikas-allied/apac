<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert(array (
            0 =>
                array (
                    'id' => 11,
                    'name' => 'create_role',
                    'guard_name' => 'web',
                    'created_at' => '2024-07-08 13:00:08',
                    'updated_at' => '2024-07-08 13:00:08',
                ),
            1 =>
                array (
                    'id' => 12,
                    'name' => 'update_role',
                    'guard_name' => 'web',
                    'created_at' => '2024-07-08 13:00:08',
                    'updated_at' => '2024-07-08 13:00:08',
                ),
            2 =>
                array (
                    'id' => 13,
                    'name' => 'delete_role',
                    'guard_name' => 'web',
                    'created_at' => '2024-07-08 13:00:08',
                    'updated_at' => '2024-07-08 13:00:08',
                ),
            3 =>
                array (
                    'id' => 14,
                    'name' => 'manage_role',
                    'guard_name' => 'web',
                    'created_at' => '2024-07-08 13:00:08',
                    'updated_at' => '2024-07-08 13:00:08',
                ),
            4 =>
                array (
                    'id' => 15,
                    'name' => 'manage_user',
                    'guard_name' => 'web',
                    'created_at' => '2024-07-08 13:00:08',
                    'updated_at' => '2024-07-08 13:00:08',
                ),
            5 =>
                array (
                    'id' => 16,
                    'name' => 'create_user',
                    'guard_name' => 'web',
                    'created_at' => '2024-07-08 13:00:08',
                    'updated_at' => '2024-07-08 13:00:08',
                ),
            6 =>
                array (
                    'id' => 17,
                    'name' => 'update_user',
                    'guard_name' => 'web',
                    'created_at' => '2024-07-08 13:00:08',
                    'updated_at' => '2024-07-08 13:00:08',
                ),
            7 =>
                array (
                    'id' => 18,
                    'name' => 'delete_user',
                    'guard_name' => 'web',
                    'created_at' => '2024-07-08 13:00:08',
                    'updated_at' => '2024-07-08 13:00:08',
                ),
        ));
    }
}
