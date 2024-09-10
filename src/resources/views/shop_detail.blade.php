@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}">
@endsection

@section('content')
<div class="shop-detail">
    <div class="shop-detail__info">
        <h2>{{ $shop->name }}</h2>
        <img class="shop-detail__img" src="{{ $shop->image }}" alt="{{ $shop->name }}"></br>
        <p class="shop-detail__tag">#{{ $shop->area }}</p>
        <p class="shop-detail__tag">#{{ $shop->genre }}</p>
        <p class="shop-detail__overview">{{ $shop->overview }}</p>
        <h3>レビュー</h3>
        @if($reviews->isEmpty())
            <p>まだレビューがありません。</p>
        @else
            @foreach($reviews as $review)
                <div class="review">
                    <p>評価: {{ $review->rating }} / 5</p>
                    <p>コメント: {{ $review->comment }}</p>
                    <p>投稿者: {{ $review->user->name }}</p>
                </div>
            @endforeach
        @endif
    </div>
    <div class="shop-detail__reservation">
        <h2 class="reservation-title">予約</h2>
        @livewire('reservation-form', ['shop' => $shop])
    </div>
</div>
@endsection