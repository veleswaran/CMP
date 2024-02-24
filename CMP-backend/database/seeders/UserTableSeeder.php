<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'firstname' => 'veleswaran',
            'lastname' => 'nagaraj',
            "phone"=>9361172225,
            'role_id'=>1,
            'email' => 'vels344@gmail.com',
            'password'=> Hash::make("Vels344@")
        ]);
    }
}
