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
            'image' => 'required|string',
        ]);

        Shop::create([
            'name' => $request->name,
            'area' => $request->area,
            'genre' => $request->genre,
            'overview' => $request->overview,
            'image' => $request->image,
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
        $validatedData = $request->validate([
            'name' => 'required|string',
            'area' => 'required|string',
            'genre' => 'required|string',
            'overview' => 'required|string',
            'image' => 'required|string',
        ]);

        $shop = Shop::find($id);
        if ($shop) {
            $shop->update($validatedData);
        }

        return redirect()->route('store.index', ['shop' => $id])->with('success', '店舗情報を更新しました');
    }
}
