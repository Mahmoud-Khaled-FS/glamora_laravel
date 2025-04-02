<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Src\Features\User\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'phone' => '01234567899',
            'password' => 'password',
            'first_name' => 'User',
            'last_name' => ' User',
        ]);
        User::factory(10)->create();
        $this->call([
            SettingsSeeder::class,
            ProductSeeder::class
        ]);
    }
}
