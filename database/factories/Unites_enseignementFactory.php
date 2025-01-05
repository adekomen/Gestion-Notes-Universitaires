<?php

namespace Database\Factories;
use App\Models\Unites_enseignement;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unites_enseignement>
 */
class Unites_enseignementFactory extends Factory
{
    protected $model = Unites_enseignement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->word(), // Code unique pour l'UE
            'nom' => $this->faker->word(), // Nom de l'UE
            'credits_ects' => $this->faker->numberBetween(3, 6), // Crédits ECTS entre 3 et 6
            'semestre' => $this->faker->numberBetween(1, 6), // Semestre entre 1 et 6

        ];
    }
}
