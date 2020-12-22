<?php

namespace App\Http\Controllers;

use App\Http\Resources\BuyerResource;
use App\Http\Resources\ProductResource;
use App\Models\Buyer;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function getCarts($id_buyer = null)
    {
        if($id_buyer){
            return BuyerResource::make(Buyer::where('id_buyer', $id_buyer)->first());
        }else{
            return BuyerResource::collection(Buyer::all());
        }
    }

    public function struct($search = '')
    {
        return ProductResource::collection(Product::where('nama_barang', 'like', "%$search%")
                                                    ->orWhere('singkatan', 'like', "%$search%")
                                                    ->orWhere('category', 'like', "%$search%")
                                                    ->paginate(10));
    }

    public function make()
    {
        request()->validate([
            'nama' => 'required|max:11'
        ]);
        $carts = Cart::getCart()->getData(true);
        if (!isset($carts['product'])) {
            return response()->json([
                'message' => 'Silahkan pilih barang terlebih dahulu.',
                'type' => 'error'
            ]);
        }else{
            $carts = $carts['product'];
        }
        $id_buyer = Product::id_uniq('BY', 'buyers', 'id_buyer');
        Buyer::create([
            'id_buyer' => $id_buyer,
            'nama' => request('nama'),
            'email' => null,
            'telepon' => '',
            'alamat' => '',
            'catatan' => ''
        ]);

        $total_harga = 0;
        foreach ($carts as $value) {
            $jml_harga = $value['jumlah'] * $value['data']['harga_barang'];
            Cart::create([
                'id_buyer' => $id_buyer,
                'id_product' => $value['data']['id_product'],
                'jml_beli' => $value['jumlah'],
                'jml_harga' => ($jml_harga)
            ]);
            $total_harga += $jml_harga;
            session()->forget('item_'.$value['data']['id_product']);
        }
        $id_transaction = date('Y').time();
        Transaction::create([
            'id' => $id_transaction,
            'id_buyer' => $id_buyer,
            'ongkir' => 0,
            'total_harga' => $total_harga,
            'kode_pesan' => 2,
            'metode' => 1,
            'bukti' => null
        ]);

        return response()->json([
            'message' => 'Barang sedang diproses, kode transaksi anda adalah '.$id_transaction.'. kode juga sudah dikirim ke alamat email kamu, silahkan cek.',
            'type' => 'success'
        ]);
    }
}
