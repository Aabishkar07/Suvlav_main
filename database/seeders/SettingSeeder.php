<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'Laravel Application By Indra '],
            ['key' => 'description', 'value' => 'Website description for ecommerce website.'],
            ['key' => 'site_email', 'value' => 'ydv.indra@gmail.com'],
            ['key' => 'site_phone', 'value' => '+977-9851236430'],
            ['key' => 'posts_per_page', 'value' => 10],
            ['key' => 'site_currency', 'value' => '$'],
            ['key' => 'users_can_register', 'value' => true],
        ];
 
        Setting::insert($settings);
    }
}
