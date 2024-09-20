<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function index()
    {
        $shopId = Auth::user()->shop_id;
        $shop = Shop::find($shopId);
        if (!$shop) {
            return redirect()->route('store.create')->with('error', '店舗が見つかりません。');
        }
        $reservations = Reservation::where('shop_id', $shopId)
                                    ->with('user', 'shop')
                                    ->get();
        return view('store.index', compact('shop', 'reservations'));
    }

    public function create()
    {
        return view('store.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'area' => 'required|string|max:191',
            'genre' => 'required|string|max:191',
            'overview' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $imageName = basename($imagePath);
        }

        Shop::create([
            'name' => $request->name,
            'area' => $request->area,
            'genre' => $request->genre,
            'overview' => $request->overview,
            'image' => $imageName,
        ]);

        return redirect()->route('store.index')->with('success', '新しい店舗が登録されました');
    }

    public function reservations()
    {
        $reservations = Reservation::where('shop_id', auth()->user()->shop->id)->get();

        return view('store.reservations', compact('reservations'));
    }

    public function edit($shopId)
    {
        $shop = Shop::findOrFail($shopId);
        return view('store.edit', compact('shop'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'area' => 'required|string|max:191',
            'genre' => 'required|string|max:191',
            'overview' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $shop = Shop::find($id);
        $shop->name = $request->input('name');
        $shop->area = $request->input('area');
        $shop->genre = $request->input('genre');
        $shop->overview = $request->input('overview');

        if ($request->hasFile('image')) {
            if ($shop->image) {
                Storage::delete('public/images/' . $shop->image);
            }

            $path = $request->file('image')->store('public/images');
            $filename = basename($path);
            $shop->image = $filename;
        }

        $shop->save();

        return redirect()->back()->with('success', '店舗情報が更新されました。');
    }
}
