@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<div class="container">
    <h2 class="change-title">予約内容の変更</h2>
    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <input class="whats-changed" type="date" name="date" value="{{ $reservation->date }}" required>
        </div>

        <div>
            <select class="whats-changed" name="time" required>
                @for ($hour = 0; $hour < 24; $hour++)
                    @for ($minute = 0; $minute < 60; $minute += 30)
                        @php
                            $timeOption = sprintf('%02d:%02d', $hour, $minute);
                            $reservationTime = \Carbon\Carbon::parse($reservation->time)->format('H:i');
                        @endphp
                        <option value="{{ $timeOption }}" @if($timeOption == $reservationTime) selected @endif>
                            {{ $timeOption }}
                        </option>
                    @endfor
                @endfor
            </select>
        </div>

        <div>
            <select class="whats-changed" name="number" required>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}" @if($i == $reservation->number) selected @endif>{{ $i }}人</option>
                @endfor
            </select>
        </div>

        <button class="change-btn" type="submit">予約を変更する</button>
    </form>
</div>
@endsection
