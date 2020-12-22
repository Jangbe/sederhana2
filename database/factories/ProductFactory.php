<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gambar = ['default.jpg', 'default1.jpg','default2.jpg', 'default3.jpg', 'default5.jpg'];
        return [
            'nama_barang' => $this->faker->word,
            'gambar' => $gambar[random_int(0, 4)],
            'harga_barang' => $this->faker->randomDigit,
            'stok' => 0,
            'category' => Category::factory(),
            'detail_stok' => '20-10-10',
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
