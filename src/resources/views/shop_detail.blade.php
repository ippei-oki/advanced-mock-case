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
    </div>
    <div class="shop-detail__reservation">
        <h2>予約</h2>
        @livewire('reservation-form', ['shop' => $shop])
    </div>
</div>
@endsection