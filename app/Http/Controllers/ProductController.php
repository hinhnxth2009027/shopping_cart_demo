<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index(){
        $products = Product::query()->orderBy('created_at','ASC')->paginate(15);
        $product_count = 0;
        if (Session::has('shoppingCart')){
            $product_count = sizeof(Session::get('shoppingCart'));
        }



        return view('client.shop',['products'=>$products,'product_count'=>$product_count]);
    }
}
