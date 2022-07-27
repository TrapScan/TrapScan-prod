<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\QR;
use App\Models\Trap;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrapFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected  $model = Trap::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $qr_code = getUniqueTrapId();
        QR::create(['qr_code' => $qr_code]);
        return [
            'nz_trap_id' => $this->faker->numberBetween(1, 100000),
            'qr_id' => $qr_code,
            'name' => $this->faker->name,
            'coordinates' => new Point($this->faker->longitude, $this->faker->latitude)
        ];
    }

    public function unmapped() {
        return $this->state(function (array $attributes) {
           return [
               'nz_trap_id' => null,
               'trap_line_id' => null,
               'project_id' => null,
               'user_id' => null,
               'name' => $this->faker->name,
               'coordinates' => new Point($this->faker->longitude, $this->faker->latitude)
           ];
        });
    }

    public function unmappedInProject(Project $project) {
        return $this->state(function (array $attributes) use($project) {
            return [
                'nz_trap_id' => null,
                'trap_line_id' => null,
                'project_id' => $project->id,
                'user_id' => null,
                'name' => $this->faker->name,
                'coordinates' => new Point($this->faker->longitude, $this->faker->latitude)
            ];
        });
    }
}
