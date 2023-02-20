<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory(5)->create();

        $user = User::first();
        $user->name = 'admin';
        $user->email = 'admin@email.com';
        $user->password = '$2y$10$lgaHuS552cgfmpDXXhvEW.Z2WVLDU.iumwh4EX6ZvEBU2XH6UfUp6'; //123
        $user->role_id = 1;
        $user->save();
    }
}
