<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $roles = [
            [
                'role' => 'student',
            ],
            [
                'role' => 'employee_company',
            ],
            [
                'role' => 'employee_education',
            ],
            [
                'role' => 'admin',
            ],
            [
                'role' => 'company',
            ],
        ];

        foreach ($roles as $role) {
            Role::query()->create($role);
        }
    }

}
