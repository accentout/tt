<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    //поиск продуктов, которые были добавлены в корзину (без учета количества)
    //по ключу user_id получем массив объектов
    public function index()
    {
        $carts =  Cart::where('user_id', auth()->id())->select('product_id')->get();

        return view('/cart', ['products' => Product::whereIn('id', $carts)->get()]);
    }

    //добавляем в таблицу carts объект, который должен быть в корзине
    public function add($id)
    {
        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $id
        ]);

        return redirect('cart');
    }

    //удаляем из корзины по ключу product_id
    public function delete($id)
    {
        Cart::where('product_id', $id)->delete();

        return redirect('cart');
    }
}
