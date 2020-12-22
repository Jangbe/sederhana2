<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getCart()
    {
        $data = [];
        $data['count'] = 0;
        $data['jumlah'] = 0;
        $data['harga'] = 0;
        foreach(session()->all() as $key => $value){
            if(substr($key, 0, 5) == 'item_'){
                $item = substr($key, 5, (strlen($key) -1));
                $produk = Product::where('id_product', $item)->first();
                $data['product'][] = [
                    'data' => $produk,
                    'jumlah' => $value
                ];
                $data['jumlah'] += $value;
                $data['harga'] += ($value * $produk->harga_barang);
                $data['count']++;
            }
        }
        return response()->json($data);
    }
}
