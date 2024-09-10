<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Review;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create($shopId)
    {
        $shop = Shop::findOrFail($shopId);
        return view('reviews.create', compact('shop'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        $review = new Review();
        $review->shop_id = $request->input('shop_id');
        $review->user_id = auth()->id();
        $review->rating = $request->input('rating');
        $review->comment = $request->input('comment');
        $review->save();

        Reservation::where('shop_id', $review->shop_id)
                    ->where('user_id', auth()->id())
                    ->delete();

        return redirect()->route('mypage')->with('success', '評価が完了しました。予約情報を削除しました。');
    }

}
