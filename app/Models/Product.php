<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function id_uniq($prefix, $table,$colloum){
        $id = DB::table($table)->latest()->first();
        if($id){
            $last = $id->$colloum;
            $last = substr($last,-4)+1;
        }else{
            $last = 1;
        }

        if($last <= 9){
            $final = '000'.$last;
        }else if($last <= 99){
            $final = '00'.$last;
        }else if($last <= 999){
            $final = '0'.$last;
        }else if($last <= 9999){
            $final = $last;
        }

        return $prefix.$final;
    }

    public static function convertStok($data){
        $produk = Product::join('categories', 'categories.slug', 'products.category')->where('products.id_product', $data->id)->first();
        $detail_stok = explode('-', $produk->detail_stok);
        $detail_nama = explode('-', $produk->detail_nama);
        $detail = [];
        for($i = 0; $i < count($detail_stok); $i++){
            $detail[$detail_nama[$i]] = $detail_stok[$i];
        }
        $data['hasil'] = 0;
        $i = 0;
        foreach($data->detail as $key => $value){
            $data['hasil'] += $value * $detail[$key];
        }
        return $data;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category', 'slug');
    }
}
