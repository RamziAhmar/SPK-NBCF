<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['username' => 'admin', 'password' => Hash::make('1111'), 'role' => 'admin'],
            ['username' => 'user', 'password' => Hash::make('1111'), 'role' => 'user'],
        ]);
    }
}
