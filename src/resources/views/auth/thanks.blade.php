@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-card">
  <div class="message">
    <a>会員登録ありがとうございます</a>
  </div>
  <div class="login-button">
    <a class="login-button_cha"href="/login">ログインする</a>
  </div>
</div>
@endsection