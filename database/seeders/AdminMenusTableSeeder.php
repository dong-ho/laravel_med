<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function Pest\Laravel\put;

class AdminMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin_menus')->insert([
            [
                'name'  => 'Home',
                'parent_id' => null,
                'sort_order' => 0,
                'url' => 'admin.index',
                'icon' => 'home-circle',
                'level' => 2,
            ],
            [
                'name'  => 'App setting',
                'parent_id' => null,
                'sort_order' => 0,
                'url' => null,
                'icon' => 'cog',
                'level' => 8,
            ],
            [
                'name' => '관리자 메뉴 설정',
                'parent_id' => 2,
                'sort_order' => 0,
                'url' => 'admin.menu',
                'icon' => '',
                'level' => 8,
            ],
            [
                'name' => '관리자 설정',
                'parent_id' => 2,
                'sort_order' => 1,
                'url' => 'admin.user',
                'icon' => '',
                'level' => 8,
            ],
        ]);

    }
}
