<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DailyReport>
 */
class DailyReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'task_id' => $this->faker->numberBetween($min=1, $max=2),
            'employee_id' => $this->faker->numberBetween($min=1, $max=2),
            'description' => $this->faker->sentence(mt_rand(3, 5)),
            'date' => $this->faker->dateTime(),
            // 'total_minutes' => $this->faker->numberBetween(),
        ];
    }
}
