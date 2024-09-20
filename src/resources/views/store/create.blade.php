@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store_create.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1 class="title">新しい店舗を登録</h1>

        <form action="{{ route('store.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="shop-info">
                <div>
                    <label for="name">Shop name:</label>
                    <input class="input-area" type="text" name="name" id="name" required>
                </div>

                <div>
                    <label for="area">Area:</label>
                    <select class="input-area" name="area" id="area" required>
                        <option value="東京都">東京都</option>
                        <option value="大阪府">大阪府</option>
                        <option value="福岡県">福岡県</option>
                    </select>
                </div>

                <div>
                    <label for="genre">Genre:</label>
                    <select class="input-area" name="genre" id="genre" required>
                        <option value="寿司">寿司</option>
                        <option value="焼肉">焼肉</option>
                        <option value="居酒屋">居酒屋</option>
                        <option value="イタリアン">イタリアン</option>
                        <option value="ラーメン">ラーメン</option>
                    </select>
                </div>

                <div class="shop-info__overview">
                    <label for="overview">Overview:</label>
                    <textarea class="text-area" name="overview" id="overview" required></textarea>
                </div>

                <div>
                    <label for="image">Image:</label>
                    <input class="input-area" type="file" name="image" id="image" required>
                </div>
            </div>

            <button class="submit-btn" type="submit">登録</button>
        </form>
    </div>
@endsection