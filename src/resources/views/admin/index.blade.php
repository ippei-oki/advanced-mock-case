@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1 class="title">管理者ダッシュボード</h1>
        <a class="button" href="{{ route('admin.store-representatives.create') }}">店舗代表者を作成</a>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>
@endsection