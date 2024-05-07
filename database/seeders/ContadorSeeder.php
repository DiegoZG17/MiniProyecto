<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class ContadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Contador',
            'email' => 'contador@gmail.com',
            'password' => bcrypt('contador@gmail.com'),
            'role' => 'contador',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
