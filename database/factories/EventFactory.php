<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'location' => $this->faker->city,
            'description' => $this->faker->paragraph,
            'capacity' => $this->faker->numberBetween(50, 500),
            'created_by'=>$this->faker->numberBetween(1, 100),
            'date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'time' => $this->faker->time('H:i:s'),
        ];
    }
}
