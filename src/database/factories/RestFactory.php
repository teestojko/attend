<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Models\Rest;

class RestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Rest::class;
    
    public function definition()
    {
        return [
            'attendance_id' => $this->faker->numberBetween(1,3),
            'break_in' => Carbon::now()->format('H:i'),
            'break_out' => Carbon::now()->format('H:i'),
        ];
    }
}
