<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Exception;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index(){
        $name='samurai';
        $languages=['HTML','CSS','JavaScript','PHP'];

        

        //変数$nameをindex.blade.phpファイルに渡す
        return view('index',compact('name','languages'));
    }
}
