<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Src\Features\Setting\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::insert([
            [
                'key' => 'app_name',
                'value' => 'Noore',
                'value_ar' => null,
            ],
            [
                'key' => 'about_us',
                'value' => 'Noore is a platform for finding and sharing jobs.',
                'value_ar' => 'نوور هو منصة للبحث عن وظائف والمشاركة فيها.',
            ],
            [
                'key' => 'contact_us',
                'value' => 'Contact us',
                'value_ar' => 'اتصل بنا',
            ]
        ]);
    }
}
