<?php

namespace Database\Factories;

use App\Models\TrapLine;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrapLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected  $model = TrapLine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'sponsored_by' => $this->faker->company
        ];
    }
}
