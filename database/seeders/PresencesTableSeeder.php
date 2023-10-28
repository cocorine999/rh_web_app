<?php

namespace Database\Seeders;

use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Presence::factory()->count(25)->create();

        $date = Carbon::parse('2021-09-29')->format('Y-m-d');

        $out_date = ['08:30','09:00','09:30','11:00','11:30','10:00','10:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30',];
        $in_date = ['07:30','08:00','08:20','09:00','09:30','11:00','11:30','10:00','10:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30',];

        do {
            DB::table('presences')->insert([
                'created_at' => Carbon::parse(Carbon::parse($date)->format('Y-m-d').', 08:00')->format('Y-m-d, h:m'),
                'in_at' => Carbon::parse(Carbon::parse($date)->format('Y-m-d').', 08:00')->format('Y-m-d, h:m'),
                'out_at' => Carbon::parse(Carbon::parse($date)->format('Y-m-d').', 16:00')->format('Y-m-d, h:m'),
                'is_present' => 1,
                'user_id' => 1,
            ]);
            DB::commit();
            $date = Carbon::parse($date)->addDay();
        } while ($date <= Carbon::parse('2021-10-10'));


    }
}
