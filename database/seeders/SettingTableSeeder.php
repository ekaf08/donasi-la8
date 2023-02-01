<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'email' => 'support@email.com',
            'phone' => '083833331865',
            'owner_name' => 'Administrator',
            'company_name' => 'Azka Jaya',
            'short_description' => '-',
            'keyword' => '-',
            'about' => '-',
            'address' => '-',
            'postal_code' => 60227,
            'city' => '-',
            'province' => '-',
        ]);
    }
}
