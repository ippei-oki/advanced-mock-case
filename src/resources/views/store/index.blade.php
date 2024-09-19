@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store_index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1 class="title">店舗情報管理</h1>
        <div class="button-wrapper">
            <a class="button" href="{{ route('store.create') }}">新しい店舗を登録</a>
        </div>

        <div class="shop-info">
            <h2>登録済みの店舗</h2>
            <p>Shop name: {{ $shop->name }}</p>
            <p>Area: {{ $shop->area }}</p>
            <p>Genre: {{ $shop->genre }}</p>
        </div>
        <div class="button-wrapper">
            <a class="button" href="{{ route('store.edit', $shop->id) }}">店舗情報を更新</a>
        </div>
        
        <h2 class="title">予約一覧</h2>
        <ul class="reservation-list">
            @foreach ($reservations as $reservation)
                <li>
                    Shop name: {{ $reservation->shop->name }}
                    <br>
                    {{ $reservation->user->name }}様 - {{ $reservation->date }} - {{ $reservation->time }} - {{ $reservation->number }}人
                </li>
            @endforeach
        </ul>
    </div>
@endsection