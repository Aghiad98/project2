<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin= User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password'=>bcrypt('password')
        ]);
        $admin->assignRole('admin');
    }
}
