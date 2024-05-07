<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class VendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Vendedor',
            'email' => 'vendedor@gmail.com',
            'password' => bcrypt('vendedor@gmail.com'),
            'role' => 'vendedor',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
