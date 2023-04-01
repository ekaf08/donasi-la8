<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

use App\Models\M_Menu;
use App\Models\M_Role_Menu;
use App\Models\M_Menu_Sub;
use App\Models\M_Role_Menu_sub;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = json_decode(File::get('database/data/m_menu.json'));
        $role_menus = json_decode(File::get('database/data/m_role_menu.json'));
        $menu_subs = json_decode(File::get('database/data/m_menu_sub.json'));
        $role_menu_subs = json_decode(File::get('database/data/m_role_menu_sub.json'));


        foreach ($menus as $key => $menu) {
            M_Menu::create([
                'id' => $menu->id,
                'nama_menu' => $menu->nama_menu,
                'go_to' => $menu->go_to,
                'has_sub' => $menu->has_sub,
                'icon' => $menu->icon,
                'active' => $menu->active,
            ]);
        }

        foreach ($role_menus as $key => $role_menu) {
            M_Role_Menu::create([
                'id' => $role_menu->id,
                'id_role' => $role_menu->id_role,
                'id_menu' => $role_menu->id_menu,
                'alias_menu' => $role_menu->alias_menu,
                'urutan' => $role_menu->urutan,
            ]);
        }

        foreach ($menu_subs as $key => $menu_sub) {
            M_Menu_Sub::create([
                'id' => $menu_sub->id,
                'id_menu' => $menu_sub->id_menu,
                'nama_sub_menu' => $menu_sub->nama_sub_menu,
                'go_to' => $menu_sub->go_to,
                'icon' => $menu_sub->icon,
                'active' => $menu_sub->active,
            ]);
        }

        foreach ($role_menu_subs as $key => $role_menu_sub) {
            M_Role_Menu_sub::create([
                'id' => $role_menu_sub->id,
                'id_role_menu' => $role_menu_sub->id_role_menu,
                'id_sub_menu' => $role_menu_sub->id_sub_menu,
                'alias_sub_menu' => $role_menu_sub->alias_sub_menu,
            ]);
        }
    }
}
