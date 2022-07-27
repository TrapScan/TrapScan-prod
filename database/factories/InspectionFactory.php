<?php

namespace Database\Factories;

use App\Models\Inspection;
use Illuminate\Database\Eloquent\Factories\Factory;

class InspectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected  $model = Inspection::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTime(),
//            'trap_id',
//            'recorded_by',
            'strikes' => $this->faker->numberBetween(0, 3),
            'species_caught' => $this->faker->word(),
            'status' => $this->faker->randomElement(['Broken', 'Ok', 'Missing']),
            'rebaited' => $this->faker->boolean,
            'bait_type' => $this->faker->randomElement(['Rabbit', 'Peanut Butter', 'Egg']),
            'trap_condition' => $this->faker->randomElement(['Ok', 'Broken', 'Missing']),
            'notes' => $this->faker->sentence,
            'words' => $this->faker->sentence,
        ];
    }
}
