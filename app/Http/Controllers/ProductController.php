<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @throws Exception
     */
    public function index()
    {
        return view('test', ['test' => 'Test is gelukt']);
    }


//    API
    public function products(){
        return Product::all();
    }

}
