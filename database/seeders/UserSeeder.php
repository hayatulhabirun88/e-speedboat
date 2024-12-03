<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'nama' => 'Admin User',
                'umur' => 30,
                'alamat' => 'Jl. Admin Raya No.1',
                'email' => 'admin@egmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'level' => 'admin',
                'remember_token' => \Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
