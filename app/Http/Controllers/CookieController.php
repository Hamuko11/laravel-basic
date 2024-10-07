<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;

class CookieController extends Controller
{
    public function index(){
        //クッキーから'product_id'キーの値を取得する
        $product_id=Cookie::get('product_id');
        $product = Product::find($product_id);
        return view('cookies.index',compact('product'));
    }

    public function create(){
        $products=Product::all();

        return view('cookies.create',compact('products'));
    }

    public function store(Request $request){
        $request->validate([
            'product_id'=>'required|exists:products,id'
        ]);

        //キー名が'product_id'、値が商品IDのデータをクッキーに設定する
        Cookie::queue('product_id',$request->input('product_id'),60);

        //HTTPレスポンスと同時にクッキー送信
        return redirect('/cookies');
    }

    public function destroy(){
        //クッキーから'product_id'キーとその値を削除
        Cookie::quque(Cookie::forget('product_id'));

        //HTTPレスポンス送信と同時にクッキー削除
        return redirect('/cookies');
    }
}
