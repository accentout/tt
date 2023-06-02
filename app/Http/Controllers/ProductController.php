<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    //страница создания товара, категории изначально в бд
    public function create()
    {
        return view('/admin.create', ['categories' => Category::all()]);
    }

    //сохраняем в таблицу созданный товар
    public function createStore(ProductRequest $request)
    {
        $data = $request->validated();

        $images = [];
        foreach ($data['images'] as $image)
            $images[] = $image->move('images', $image->getClientOriginalName());

        Product::create([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'cost' => $data['cost'],
            'size' => $data['size'],
            'cover' => $data['cover']->move('images', $data['cover']->getClientOriginalName()),
            'images' => implode(' ', $images),
            'description' => $data['description']
        ]);

        return redirect(route('create'));
    }
}
