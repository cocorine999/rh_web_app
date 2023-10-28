<?php

namespace Database\Factories;

use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Permission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'motif' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(2),
            'start_at' => Carbon::parse('2021-10-17 08:00'),
            'end_at' => Carbon::parse('2021-10-17 18:00'),
            'is_accept' => 1,
            'is_conge' => 2,
            'user_id' => 13,
        ];
    }
}
