<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Super Admin',
             'email' => 'admin@gmail.com',
             'password' => bcrypt(12345678),
             'mobile' => 0,
             'user_type' => 1,
             'access_label' => 0,
             'website_status' => 1,
             'login_status' => 1
        ]);
    }
}
