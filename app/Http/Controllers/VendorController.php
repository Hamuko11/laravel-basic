<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function show($id){
        //URL'/vendors/{$id}のid部分と主キーのidカラムが一致する
        //データをvendorsテーブルから取得し変数に代入する
        $vendor = Vendor::find($id);
        //インスタンスに紐づくproductsテーブルすべてのデータをコレクションとして取得する
        $products = $vendor->products;

        //変数vendorとproductsをvendors/show.blade.phpに渡す
        return view('vendors.show',compact('vendor','products'));
    }

    public function create(){
        return view('vendors.create');
    }

    public function store(Request $request) {
        // バリデーションを設定する
        $request->validate([
            'vendor_code' => 'required|integer|min:0|unique:vendors,vendor_code',
            'vendor_name' => 'required|max:255'
        ]);

        // フォームの入力内容をもとに、テーブルにデータを追加する
        $vendor = new Vendor();
        $vendor->vendor_code = $request->input('vendor_code');
        $vendor->vendor_name = $request->input('vendor_name');
        $vendor->save();

        // リダイレクトさせる
        return redirect("/vendors/{$vendor->id}");
    }      
}