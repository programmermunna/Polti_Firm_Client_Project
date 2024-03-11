<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Setting::insert([
            [
                'id'           => 1,
                'project_name'         => 'ইসবাহ পোল্টি ফার্ম',
                'project_title'         => 'ইসবাহ পোল্টি ফার্ম',
                'project_phone'         => '+880123456789',
                'project_email'         => 'mail@isbah.com',
                'project_address'         => 'Dhaka, Bangladesh',
                'project_logo'         => '1710089030.png',
            ]
        ]);
    }
}
