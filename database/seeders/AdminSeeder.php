<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
           'name' => 'admin',
           'email' => 'admin@admin.com',
           'email_verified_at' => now(),
            'password' => Hash::make('admin@1234'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
