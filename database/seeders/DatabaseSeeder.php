<?php

namespace Database\Seeders;

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
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'admin',
            'role' => 'superadmin',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Staff',
            'email' => 'staff@mail.com',
            'password' => 'staff',
            'role' => 'staff',
        ]);
        \App\Models\Customer::factory()->count(10)->create();
        \App\Models\Item::factory()->count(10)->create();
    }
}
