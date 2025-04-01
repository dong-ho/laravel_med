<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            AdminMenusTableSeeder::class
        ]);
        //User::factory(10)->create();

        /**
         * user factory를 통한 계정 생성
        */
        /*User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'level' => 9,
            'role' => 'admin',
        ]);*/



    }
}
