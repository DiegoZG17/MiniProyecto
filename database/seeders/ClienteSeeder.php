<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Cliente',
            'email' => 'cliente@gmail.com',
            'password' => bcrypt('cliente@gmail.com'),
            'role' => 'cliente',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
