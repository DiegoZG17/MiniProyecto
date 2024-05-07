<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Supervisor',
            'email' => 'supervisor@gmail.com',
            'password' => bcrypt('supervisor@gmail.com'),
            'role' => 'supervisor',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
