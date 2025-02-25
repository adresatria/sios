<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'organization_name' => $this->faker->company,
            'organization_type' => $this->faker->randomElement(['PT', 'CV', 'UD']),
            'address' => $this->faker->address,
            'npwp' => $this->faker->numerify('##.###.###.#-###.###'),
            'contact_organization' => $this->faker->phoneNumber,
        ];
    }
}
