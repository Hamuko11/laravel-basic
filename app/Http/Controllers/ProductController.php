<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Vendor;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends Controller
{
    public function index()
    {
        //productsテーブルからすべてを取得し変数に代入
        $products = DB::table('products')->get();
        //変数をindex.blade.phpに渡す
        //compactは変数名とその値から配列を作成する
        return view('products.index', compact('products'));
    }
    //$idのページを見る
    public function show($id)
    {
        //URL'/products/{id}'の{id}部分とidカラムの値が一致
        //するデータをproductsテーブルから取得し変数に代入する
        $product = Product::find($id);
        //変数をproducts/show.blade.phpに渡す
        return view('products.show', compact('product'));
    }



    public function create()
    {
        $vendor_codes = Vendor::pluck('vendor_code');

        return view('products.create', compact('vendor_codes'));
    }

    public function store(ProductStoreRequest $request)
    {
        // フォームの入力内容をもとに、テーブルにデータを追加する
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->vendor_code = $request->input('vendor_code');

        // アップロードされたファイル（name="image"）が存在すれば処理を実行する
        if ($request->hasFile('image')) {
            // アップロードされたファイル（name="image"）をstorage/app/public/productsフォルダに保存し、戻り値（ファイルパス）を変数$image_pathに代入する
            $image_path = $request->file('image')->store('public/products');
            // ファイルパスからファイル名のみを取得し、Productインスタンスのimage_nameプロパティに代入する
            $product->image_name = basename($image_path);
        }

        $product->save();

        // リダイレクトさせる
        return redirect("/products/{$product->id}");
    }
}
