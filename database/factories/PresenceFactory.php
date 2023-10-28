<?php

namespace Database\Factories;

use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PresenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Presence::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = Carbon::parse('2021-09-27')->format('Y-m-d');
        $data = [];
        /* do {
            array_push($data,[
                'in_at' => Carbon::parse(Carbon::parse($date)->format('Y-m-d').', 08:00')->format('Y-m-d, h:m'),
                'out_at' => Carbon::parse(Carbon::parse($date)->format('Y-m-d').', 16:00')->format('Y-m-d, h:m'),
                'is_present' => 1,
                'user_id' => 1,
            ]);

            $date = Carbon::parse($date)->addDay();
        } while ($date <= Carbon::parse('2021-10-21')); */
        return [
            'created_at' => Carbon::parse(Carbon::parse($date)->format('Y-m-d').' 05:05:20'),
            'in_at' => Carbon::parse(Carbon::parse($date)->format('Y-m-d').' 08:05')->format('Y-m-d h:m'),
            'out_at' => Carbon::parse(Carbon::parse($date)->format('Y-m-d').' 21:00')->format('Y-m-d h:m'),
            'is_present' => 1,
            'user_id' => 1,
        ];
    }
}
