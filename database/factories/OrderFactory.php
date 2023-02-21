<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "grand_total"=>0,
            "status"=>0,
            "shipping_address"=>$this->faker->address,
            "telephone"=>$this->faker->phoneNumber
        ];
    }
}
