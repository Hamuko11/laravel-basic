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
}
