<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * user 개별 생성
         */
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@test.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'level' => 9,
                'role' => 'admin'
            ],
            [
                'name' => 'Agent User',
                'email' => 'agent@test.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'level' => 7,
                'role' => 'agent'
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@test.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'level' => 2,
                'role' => 'user'
            ]
        ]);

    }
}
