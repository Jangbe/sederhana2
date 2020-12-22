<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gambar = ['default.jpg', 'default1.jpg','default2.jpg', 'default3.jpg', 'default5.jpg'];
        $harga = [12000, 6000, 14000, 23000, 1000, 500, 18500];
        $category = [
            'Rokok' => '20-10-1',
            'Makanan' => '12-1',
            'Minuman' => '6-1',
            'Minuman Botol' => '24-1',
            'Bahan Masak' => '12-1'
        ];
        $faker = Factory::create();
        $index = 1;
        foreach ($category as $key => $value) {
            for($i = 0; $i < 5; $i++){
                if($index <= 9){
                    $id_product = 'PD000'.$index;
                }else if($index <= 99){
                    $id_product = 'PD00'.$index;
                }
                Product::create([
                    'id_product' => $id_product,
                    'nama_barang' => $faker->word,
                    'singkatan' => $faker->word,
                    'gambar' => $gambar[random_int(0, 4)],
                    'harga_barang' => $harga[random_int(0, count($harga) - 1)],
                    'stok' => 200,
                    'category' => Str::slug($key),
                    'detail_stok' => $value
                ]);
                $index++;
            }

        }
    }
}
