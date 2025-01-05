<?php

namespace Database\Factories;
use App\Models\Etudiant;
use App\Models\Elements_constitutif;
use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'etudiant_id' => Etudiant::factory(),
            'ec_id' => Elements_constitutif::factory(),
            'note' => $this->faker->numberBetween(0, 20),
            'session' => $this->faker->randomElement(['normale', 'rattrapage']),
            'date_evaluation' => $this->faker->date(),

        ];
    }
}
