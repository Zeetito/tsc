<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'KNUST',
            'is_host' => 1,
            'email' => 'knustchurchofchrist@gmail.com',
            'password' => bcrypt('roms1616'), // password
        ]);
        // User::create([
            // 'name' => 'UCC',
            // 'is_host' => 0,
            // 'email' => 'ucc@gmail.com',
            // 'password' => bcrypt('password'), // password
        // ]);

    }
}
