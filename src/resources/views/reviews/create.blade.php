@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<div class="container">
    <h2 class="review-title">{{ $shop->name }}の評価を投稿</h2>

    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <input type="hidden" name="shop_id" value="{{ $shop->id }}">

        <div class="review-content">
            <label for="rating">星評価 (1～5):</label>
            <select class="review-content-stars" name="rating" id="rating">
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="review-content">
            <label class="review-content-label" for="comment">コメント:</label>
            <textarea class="review-content-comment" name="comment" id="comment"></textarea>
        </div>

        <button class="send-btn" type="submit">評価を送信</button>
    </form>
</div>
@endsection
