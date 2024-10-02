@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1 class="title">管理者ダッシュボード</h1>
        <div class="button-area">
            <a class="button" href="{{ route('admin.store-representatives.create') }}">店舗代表者を作成</a>
            <a class="button" href="{{ route('admin.notifications.index') }}">お知らせメール送信</a>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
@endsection