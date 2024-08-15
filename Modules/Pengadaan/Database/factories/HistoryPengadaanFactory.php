<?php
namespace Modules\Pengadaan\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Pengadaan\Entities\HistoryPengadaan;
use Modules\Pengadaan\Entities\Pengadaan;
use Modules\Pengadaan\Entities\Status;

class HistoryPengadaanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HistoryPengadaan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pengadaan_id' => Pengadaan::factory(), // Membuat relasi ke model Pengadaan
            'status_lama' => Status::factory(), // Membuat relasi ke model Status
            'status_baru' => Status::factory(), // Membuat relasi ke model Status
            'keterangan' => $this->faker->sentence,
        ];
    }
}

