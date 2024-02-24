<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles =[
            ['name'=>'Super Admin'],
            ['name'=>'Care Giver'],
            ['name'=>'Care Seeker'],
            ['name'=>'Care Agent'],
        ];
        Role::insert($roles);
    }
}
