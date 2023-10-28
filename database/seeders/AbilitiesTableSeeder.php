<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('abilities')->insert([
            'name' => "Manage access",
            'slug' => "manage-access",
        ]);

        DB::table('abilities')->insert([
            'name' => "View access",
            'slug' => "view-access",
        ]);

    }
}
