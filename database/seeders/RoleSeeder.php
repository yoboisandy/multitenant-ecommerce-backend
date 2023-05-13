<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate([
                'name' => $role
            ], [
                'guard_name' => 'web',
            ]);
        };
    }
}
