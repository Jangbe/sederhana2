<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($category = null)
    {
        if($category){
            $product = Product::where('category', $category)->get();
        }else{
            $product = Product::get();
        }
        return ProductResource::collection($product);
    }

    public function show(Product $id)
    {
        return ProductResource::make($id);
    }
}
