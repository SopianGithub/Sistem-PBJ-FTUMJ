<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Supplier;

class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Supplier::inRandomOrder()->first()->id,
            'nama_lengkap' => $this->faker->name(),
            'tempat_lahir' => $this->faker->address(),
            'tanggal_lahir' => $this->faker->date(),
            'nama_badan_usaha' => $this->faker->name(),
            'alamat_badan_usaha' => $this->faker->address(),
            'nomor_hp' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'alamat_web' => $this->faker->domainName(),
            'surat_penawaran' => 'test.pdf'
        ];
    }
}
