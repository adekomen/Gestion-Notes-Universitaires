<?php

namespace Database\Factories;
use App\Models\Etudiant;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
{
    protected $model = Etudiant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero_etudiant' => $this->faker->unique()->numberBetween(1000, 9999), // Numéro unique pour l'étudiant
            'nom' => $this->faker->lastName(), // Nom de famille
            'prenom' => $this->faker->firstName(), // Prénom
            'niveau' => $this->faker->randomElement(['L1', 'L2', 'L3', 'M1', 'M2']), // Niveau (Licence ou Master)

            ];

    }
}
