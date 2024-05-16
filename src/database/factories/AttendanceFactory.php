<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Models\Attendance;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Attendance::class;

    
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,3),
            'date' => Carbon::now()->toDateString(),
            'clock_in' => Carbon::now()->format('H:i'),
            'clock_out' => Carbon::now()->format('H:i'),
        ];
    }
}
