<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Daftar_barang;

class Daftar_barangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    // protected $model = AliasCommand::class;

    public function definition()
    {
        return [
            'id' => Daftar_barang::inRandomOrder()->first()->id,
            'nama_barang' => $this->faker->name(),
            'jumlah' => $this->faker->randomDigit(),
            'unit' => $this->faker->name(),
            'status' => '1'
        ];
    }
}
