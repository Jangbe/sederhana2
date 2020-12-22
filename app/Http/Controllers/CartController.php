<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function make(Request $request)
    {
        $produk = Product::where('id_product', $request->id)->first();
        $jumlah = Product::convertStok($request)['hasil'];
        if($jumlah == 0){
            return response()->json([
                'message' => 'Barang gagal dimasukan ke keranjang, jumlah tidak boleh 0',
                'type' => 'error'
            ]);
        }else{
            if($jumlah <= $produk->stok){
                $request->session()->put('item_'.$request->id, $jumlah);
                $count = $this->getCart();
                return response()->json([
                    'message' => 'Barang telah dimasukan ke keranjang',
                    'type' => 'success',
                    'count' => $count,
                    'jumlah' => $jumlah
                ]);
            }else{
                return response()->json([
                    'message' => 'Barang gagal dimasukan ke keranjang, jumlah beli melebihi stok!',
                    'type' => 'error'
                ]);
            }
        }
    }

    public function getCart()
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

    public function deleteCart($id)
    {
        $item = 'item_'.$id;
        session()->forget($item);
        return response()->json([
            'message' => 'Barang telah dihapus dari keranjang',
            'type' => 'success'
        ]);
    }

    public function store()
    {
        request()->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:buyers,email',
            'notel' => 'required|min:8|max:13',
            'alamat' => 'required',
            'metode' => 'required'
        ]);
        $id_buyer = Product::id_uniq('BY', 'buyers', 'id_buyer');
        Buyer::create([
            'id_buyer' => $id_buyer,
            'nama' => request('nama'),
            'email' => request('email'),
            'telepon' => request('notel'),
            'alamat' => request('alamat'),
            'catatan' => request('catatan')
        ]);

        $total_harga = 0;
        $carts = Cart::getCart()->getData(true)['product'];
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
        $kode_pesan = request('metode') == 1 ? 2 : 1;
        Transaction::create([
            'id' => $id_transaction,
            'id_buyer' => $id_buyer,
            'ongkir' => 0,
            'total_harga' => $total_harga,
            'kode_pesan' => $kode_pesan,
            'metode' => request('metode'),
            'bukti' => null
        ]);

        return response()->json([
            'message' => 'Barang sedang diproses, kode transaksi anda adalah '.$id_transaction.'. kode juga sudah dikirim ke alamat email kamu, silahkan cek.',
            'type' => 'success'
        ]);
    }
}
