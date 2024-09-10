<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Review;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop_list()
    {
        $shops = Shop::all();
        return view('shop_all', ['shops' => $shops]);
    }

    public function index(Request $request)
    {
        $area = $request->input('area', 'All area');
        $genre = $request->input('genre', 'All genre');
        $name = $request->input('name', '');

        $shops = Shop::query()
            ->when($area != 'All area', function($query) use ($area) {
                return $query->where('area', $area);
            })
            ->when($genre != 'All genre', function($query) use ($genre) {
                return $query->where('genre', $genre);
            })
            ->when($name != '', function($query) use ($name) {
                return $query->where('name', 'LIKE', "%$name%");
            })
            ->get();

        return view('shop_all', compact('shops', 'area', 'genre', 'name'));
    }

    public function show($id)
    {
        $shop = Shop::findOrFail($id);
        $reviews = Review::where('shop_id', $id)->get();
        return view('shop_detail', compact('shop', 'reviews'));
    }
}
