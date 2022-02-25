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
    public function run()
    {
        $roles = [
            ['id' => 1, 'name' => 'Admin'],
            ['id' => 2, 'name' => 'Student'],
            ['id' => 3, 'name' => 'StudentAdmin'],
        ];
        foreach($roles as $role){
            Role::create($role);
        }
    }
}
