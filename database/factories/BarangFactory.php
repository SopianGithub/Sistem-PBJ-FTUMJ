<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_barang' => $this->faker->name(),
            'jumlah' => $this->faker->randomDigit,
            'unit' => $this->faker->text,
            'status' => 'Active'
        ];
    }
}
