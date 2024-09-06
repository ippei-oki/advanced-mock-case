<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggleFavorite($shopId)
    {
        $user = Auth::user();
        $shop = Shop::findOrFail($shopId);

        if ($user->favorites()->where('shop_id', $shopId)->exists()) {
            $user->favorites()->detach($shopId);
        } else {
            $user->favorites()->attach($shopId);
        }

        return redirect()->back();
    }
}
