@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store_notifications.css') }}">
@endsection

@section('content')
<div class="container">
    <h1 class="title">店舗管理者向けメール送信</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('store.notifications.index') }}" method="GET">
        @csrf
        <div class="mail-contents">
            <div class="form-group">
                <label for="subject">件名:</label>
                <input type="text" name="subject" id="subject" class="form-control" required 
                       value="{{ old('subject', request('subject')) }}">
            </div>

            <div class="message-area">
                <label for="message">メッセージ:</label>
                <textarea name="message" id="message" class="text-area" rows="5" required>{{ old('message', request('message')) }}</textarea>
            </div>

            <div class="form-group">
                <label for="recipients">送信先:</label>
                <div>
                    <input type="radio" name="recipients" value="all" 
                           @if (old('recipients', request('recipients', 'all')) === 'all') checked @endif>
                    <label for="all">全ユーザー</label>
                </div>
                <div>
                    <input type="radio" name="recipients" value="specific"
                           @if (old('recipients', request('recipients')) === 'specific') checked @endif>
                    <label for="specific">特定のユーザー</label>
                </div>
            </div>

            @if (old('recipients', request('recipients')) === 'specific')
                <div id="user-selection">
            @else
                <div id="user-selection" style="display: none;">
            @endif
                <label>送信するユーザーを選択してください:</label>
                @foreach($users as $user)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="selected_users[]" value="{{ $user->id }}"
                               @if (in_array($user->id, old('selected_users', request('selected_users', [])))) checked @endif>
                        <label class="form-check-label">{{ $user->name }} ({{ $user->email }})</label>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn-primary">確認する</button>
    </form>

    @if (request('recipients'))
        <form action="{{ route('store.notifications.send') }}" method="POST">
            @csrf
            <input type="hidden" name="subject" value="{{ request('subject') }}">
            <input type="hidden" name="message" value="{{ request('message') }}">
            <input type="hidden" name="recipients" value="{{ request('recipients') }}">
            @if (request('recipients') === 'specific')
                @foreach(request('selected_users', []) as $user_id)
                    <input type="hidden" name="selected_users[]" value="{{ $user_id }}">
                @endforeach
            @endif

            <button type="submit" class="btn-primary">送信する</button>
        </form>
    @endif
</div>
@endsection
