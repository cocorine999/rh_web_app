<?php

namespace Database\Seeders;

use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'motif' => "ljsdkl jksd klsd osled oez izlksd",
            'description' => "ljsdkl jksd klsd osled oez izlksd",
            'start_at' => Carbon::parse('2021-10-10 16:00'),
            'end_at' => Carbon::parse('2021-10-11 07:00'),
            'is_accept' => 1,
            'is_conge' => 2,
            'user_id' => 13,
        ]);


        DB::table('permissions')->insert([
            'motif' => "ljsdkl jksd klsd osled oez izlksd",
            'description' => "ljsdkl jksd klsd osled oez izlksd",
            'start_at' => Carbon::parse('2021-10-17 08:00'),
            'end_at' => Carbon::parse('2021-10-17 18:00'),
            'is_accept' => 1,
            'is_conge' => 2,
            'user_id' => 13,
        ]);

        DB::commit();

        DB::table('permissions')->insert([
            'motif' => "ljsdkl jksd klsd osled oez izlksd",
            'description' => "ljsdkl jksd klsd osled oez izlksd",
            'start_at' => Carbon::parse('2021-10-21 08:00'),
            'end_at' => Carbon::parse('2021-10-25 12:00'),
            'is_accept' => -1,
            'is_conge' => 2,
            'user_id' => 13,
        ]);

    }
}
