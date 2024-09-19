@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store-representatives_create.css') }}">
@endsection

@section('content')
<div class="container">
    <h1 class="title">店舗代表者を作成</h1>

    <form action="{{ route('admin.store-representatives.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">User name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn-primary">作成</button>
    </form>
</div>
@endsection
