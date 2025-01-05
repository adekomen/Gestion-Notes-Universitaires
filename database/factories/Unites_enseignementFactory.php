<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Unites_enseignement;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unites_enseignement>
 */
class Unites_enseignementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Unites_enseignement::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->regexify('UE[0-9]{2}'),
            'nom' => $this->faker->words(3, true),
            'credits_ects' => $this->faker->numberBetween(1, 30),
            'semestre' => $this->faker->numberBetween(1, 6),
        ];
    }
}
