@extends('layouts.app')

@section('content')
<div class="verify-card">
  <h1>メール確認</h1>
  <p>確認メールを送信しました。受信箱を確認してください。</p>

  <form action="{{ route('verification.send') }}" method="post">
    @csrf
    <button type="submit">確認メールを再送信</button>
  </form>

  @if (session('status') == 'verification-link-sent')
    <p>新しい確認リンクを送信しました。</p>
  @endif
</div>
@endsection
