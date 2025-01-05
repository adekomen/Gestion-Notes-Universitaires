<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Elements_constitutif;
use App\Models\Unites_enseignement;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Elements_constitutif>
 */
class Elements_constitutifFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Elements_constitutif::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique(),
            'nom' => $this->faker->words(3, true),
            'coefficient' => $this->faker->numberBetween(1, 5),
            'ue_id' => Unites_enseignement::factory(),
        ];
    }
}
