<?php

namespace Database\Factories;

use App\Models\Pengusul;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengusulFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Pengusul::inRandomOrder()->first()->id,
            'id_user' => 4,
            'nama_pengusul' => $this->faker->name(),
            'no_identitas' => $this->faker->randomDigit(),
            'status_pengusul' => 'Prodi',
            'no_hp' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'keterangan' => $this->faker->name(),
            'surat_penawaran' => 'test.pdf'
        ];
    }
}
