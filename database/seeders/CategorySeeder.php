<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            'Rokok' => 'ball-pack-bungkus',
            'Makanan' => 'pack-bungkus',
            'Minuman' => 'pack-biji',
            'Minuman Botol' => 'krat-botol',
            'Bahan Masak' => 'gantung-bungkus'
        ];
        foreach ($category as $key => $value) {
            Category::create([
                'nama_kategori' => $key,
                'slug' => Str::slug($key),
                'detail_nama' => $value,
            ]);
        }
    }
}
