<?php

namespace App\Http\Controllers;

use App\Models\Product;

class IndexController extends Controller
{
    //главная страница с выбранными товарами
    public function index()
    {
        return view('home', ['products' => Product::all()->take(4)]);
    }

    //список всех товаров
    public function shop()
    {
        return view('shop', ['products' => Product::all()]);
    }

    //определенный товар с выбраннами товарами
    public function show($id)
    {
        return view('product-single', [
                'products' => Product::all()->take(4),
                'product' => Product::findOrFail($id),
                'id' => $id
            ]);
    }
}
