<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $kategori = ['Roko', 'Makanan', 'Minuman', 'Bahan Makanan', 'Minuman Botol'];
        $nama_kategori = array_rand($kategori);
        return [
            'nama_kategori' => $kategori[$nama_kategori],
            'slug' => Str::slug($kategori[$nama_kategori]),
            'detail_nama' => 'bal-pak-bks',
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
