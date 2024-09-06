@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="wrap">
    <div class="done">
        <p class="message">ご予約ありがとうございます</p>
        <a class="link-back" href="{{ route('shops.index') }}">戻る</a>
    </div>
</div>
@endsection