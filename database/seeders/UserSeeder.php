<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        ];

        foreach ($data as $item) {
            $user = User::updateOrCreate([
                'email' => $item['email']
            ], [
                'name' => $item['name'],
                'email' => $item['email'],
                'password' => $item['password'],
            ]);
            $user->assignRole($item['role']);
        }
    }
}
