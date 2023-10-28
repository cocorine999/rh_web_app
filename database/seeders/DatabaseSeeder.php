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
        // \App\Models\User::factory(10)->create();
        //PermissionsTableSeeder::class;
        //PresencesTableSeeder::class;
        //\App\Models\Presence::factory(1)->create();
        AbilitySeeder::class;
    }
}
