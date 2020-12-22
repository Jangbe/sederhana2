<?php

namespace App\Http\Resources;

use App\Models\Buyer;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class BuyerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $buyer = Buyer::join('transactions', 'buyers.id_buyer', 'transactions.id_buyer')->where('buyers.id_buyer', $this->id_buyer)->first();
        $products = Product::join('carts', 'products.id_product', 'carts.id_product')->where('carts.id_buyer', $this->id_buyer)->get();
        return [
            'id_buyer' => $this->id_buyer,
            'nama' => $this->nama,
            'products' => $products,
            'kode_pesan' => $buyer->kode_pesan,
            'ongkir' => $buyer->ongkir,
            'email' => $this->email,
            'telepon' => $this->telepon,
            'catatan' => $this->catatan ? $this->catatan : 'Tidak ada catatan',
            'alamat' => $this->alamat,
            'total_harga' => ($buyer->total_harga + $buyer->ongkir)
        ];
    }
}
