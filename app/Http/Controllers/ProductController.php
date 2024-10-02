<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        //productsテーブルからすべてを取得し変数に代入
        $products = DB::table('products')->get();
        //変数をindex.blade.phpに渡す
        //compactは変数名とその値から配列を作成する
        return view('products.index',compact('products'));
    }
    //$idのページを見る
    public function show($id){
        //URL'/products/{id}'の{id}部分とidカラムの値が一致
        //するデータをproductsテーブルから取得し変数に代入する
        $product = Product::find($id);
        //変数をproducts/show.blade.phpに渡す
        return view('products.show',compact('product'));
    }
}
