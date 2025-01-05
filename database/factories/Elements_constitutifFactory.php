<?php

namespace Database\Factories;
use App\Models\Elements_constitutif;
use App\Models\Unites_enseignement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Elements_constitutif>
 */
class Elements_constitutifFactory extends Factory
{
    protected $model = Elements_constitutif::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'code' => $this->faker->unique()->word(), // Génère un code unique pour l'EC
            'nom' => $this->faker->word(), // Nom de l'EC
            'coefficient' => $this->faker->randomFloat(1, 1, 10), // Coefficient entre 1 et 10
             'ue_id'=> Unites_enseignement::factory(),
        ];
    }
}
