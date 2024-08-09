<?php
namespace Modules\Pengadaan\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Pengadaan\Entities\Document;

class DocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Pengadaan\Entities\Document::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_dokumen' => $this->faker->word,
            'file' => $this->faker->word . '.docx',
            'deskripsi' => $this->faker->sentence,
        ];
    }
}
