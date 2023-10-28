<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Ability::create([
            'name' => "Manage access",
            'slug' => "manage-access",
        ]);
    }
}
