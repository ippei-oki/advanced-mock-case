@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_all.css') }}">
@endsection

@section('search')
<div class="search-bar">
    <form action="{{ route('shops.index') }}" method="GET">
        @csrf
        <select name="area" onchange="this.form.submit()">
            <option value="All area" {{ $area == 'All area' ? 'selected' : '' }}>All area</option>
            <option value="東京都" {{ $area == '東京都' ? 'selected' : '' }}>東京都</option>
            <option value="大阪府" {{ $area == '大阪府' ? 'selected' : '' }}>大阪府</option>
            <option value="福岡県" {{ $area == '福岡県' ? 'selected' : '' }}>福岡県</option>
        </select>

        <select name="genre" onchange="this.form.submit()">
            <option value="All genre" {{ $genre == 'All genre' ? 'selected' : '' }}>All genre</option>
            <option value="寿司" {{ $genre == '寿司' ? 'selected' : '' }}>寿司</option>
            <option value="焼肉" {{ $genre == '焼肉' ? 'selected' : '' }}>焼肉</option>
            <option value="居酒屋" {{ $genre == '居酒屋' ? 'selected' : '' }}>居酒屋</option>
            <option value="イタリアン" {{ $genre == 'イタリアン' ? 'selected' : '' }}>イタリアン</option>
            <option value="ラーメン" {{ $genre == 'ラーメン' ? 'selected' : '' }}>ラーメン</option>
        </select>

        <input type="text" name="name" placeholder="Search…" value="{{ $name }}" onblur="this.form.submit()">
    </form>
</div>
@endsection

@section('content')
    <div class="wrapper">
        @foreach ($shops as $shop)
            <div class="card">
                <div class="card__img">
                    <img src="{{ $shop->image }}"></img>
                </div>
                <div class="card__content">
                    <h2>{{ $shop->name }}</h2>
                    <div class="card__content-tag">
                        <p class="card__content-tag-area">#{{ $shop->area }}</p>
                        <p class="card__content-tag-genre">#{{ $shop->genre }}</p>
                    </div>
                    <div class="card__content-line">
                        <div class="card__content-link">
                            <a class="card__content-link-tag" href="{{ route('shops.show', ['id' => $shop->id]) }}">詳しくみる</a>
                        </div>
                        <div class="card__content-favorite-btn">
                            <form action="{{ route('favorite.toggle', $shop->id) }}" method="POST">
                                @csrf
                                @if(Auth::check() && Auth::user()->favorites->contains($shop->id))
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
@endsection