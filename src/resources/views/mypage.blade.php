@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="container">
    <h2 class="user-name">{{ $user->name }}さん</h2>

    <div class="info">
        <div class="reservations-info">
            <h3>予約状況</h3>
            @if($reservations->isEmpty())
                <p>予約がありません。</p>
            @else
                <ul class="reservation-list">
                    @foreach($reservations as $reservation)
                        <li class="reservation-card">
                            <span>予約</span> {{ $loop->iteration }}
                            <form class="delete-btn" action="{{ route('reservation.cancel', $reservation->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">×</button>
                            </form>
                            <br>
                            <table class="reservation-summary">
                                <tr><td>Shop</td><td>{{ $reservation->shop->name }}</td></tr>
                                <tr><td>Date</td><td>{{ $reservation->date }}</td></tr>
                                <tr><td>Time</td><td>{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</td></tr>
                                <tr><td>Number</td><td>{{ $reservation->number }}人</td></tr>
                            </table>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="favorites-info">
            <h3>お気に入り店舗</h3>
            @if($favorites->isEmpty())
                <p>お気に入り店舗がありません。</p>
            @else
                <div class="wrapper">
                    @foreach($favorites as $favorite)
                        <div class="card">
                            <div class="card__img">
                                <img src="{{ $favorite->shop->image }}" alt="Shop Image">
                            </div>
                            <div class="card__content">
                                <h2>{{ $favorite->shop->name }}</h2>
                                <div class="card__content-tag">
                                    <p class="card__content-tag-area">#{{ $favorite->shop->area }}</p>
                                    <p class="card__content-tag-genre">#{{ $favorite->shop->genre }}</p>
                                </div>
                                <div class="card__content-line">
                                    <div class="card__content-link">
                                        <a class="card__content-link-tag" href="{{ route('shops.show', ['id' => $favorite->shop->id]) }}">詳しくみる</a>
                                    </div>
                                    <div class="card__content-favorite-btn">
                                        <form action="{{ route('favorite.toggle', $favorite->shop->id) }}" method="POST">
                                            @csrf
                                            @if(Auth::check() && Auth::user()->favorites->contains($favorite->shop->id))
                                                <button type="submit" style="background:none; border:none;">
                                                    <span style="color:red; font-size:40px;">&#10084;</span>
                                                </button>
                                            @else
                                                <button type="submit" style="background:none; border:none;">
                                                    <span style="color:gray; font-size:40px;">&#10084;</span>
                                                </button>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
