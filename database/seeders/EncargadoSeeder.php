<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class EncargadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Encargado',
            'email' => 'encargado@gmail.com',
            'password' => bcrypt('encargado@gmail.com'),
            'role' => 'encargado',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
