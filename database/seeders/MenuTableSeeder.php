<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\M_Menu;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        M_Menu::create([
            'nama_menu' => 'Dashboard',
            'go_to' => 'dashboard',
            'has_sub' => 'f',
            'icon' => 'nav-icon fas fa-tachometer-alt',
            'active' => 'dashboard',
            'group_menu' => 'dashboard',
        ], [
            'nama_menu' => 'Kategori',
            'go_to' => 'category.index',
            'has_sub' => 'f',
            'icon' => 'nav-icon fas fa-cube',
            'active' => 'category',
            'group_menu' => 'master',
        ], [
            'nama_menu' => 'Projek',
            'go_to' => 'campaign.index',
            'has_sub' => 'f',
            'icon' => 'nav-icon fas fa-project-diagram',
            'active' => 'campaign',
            'group_menu' => 'master',
        ]);
    }
}
