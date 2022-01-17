<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address_line_1' => $this->faker->address(),
            'address_line_2' => $this->faker->address(),
            'country' => $this->faker->century(),
            'state' => $this->faker->century(),
            'city' => $this->faker->city(),
            'postal' => $this->faker->postcode(),
        ];
    }
}
