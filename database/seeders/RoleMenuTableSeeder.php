<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\M_Role_Menu;

class RoleMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        M_Role_Menu::create(
            [
                'id_role' => '1', //admin
                'id_menu' => '1',
                'alias_menu' => 'dashboard',
                'urutan' => '1',
            ],
            [
                'id_role' => '1',
                'id_menu' => '2',
                'alias_menu' => 'kategori',
                'urutan' => '1',
            ],
            [
                'id_role' => '1',
                'id_menu' => '3',
                'alias_menu' => 'projek',
                'urutan' => '1',
            ],
            [
                'id_role' => '2', //donatur
                'id_menu' => '1',
                'alias_menu' => 'dashboard',
                'urutan' => '1',
            ],

        );
    }
}
