<div>
    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <div>
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            <input class="reservation-contents" type="date" wire:model="date" name="date" required>
            <select class="reservation-contents" wire:model="time" name="time" required>
                @for ($hour = 0; $hour < 24; $hour++)
                    @for ($minute = 0; $minute < 60; $minute += 30)
                        @php
                            $timeOption = sprintf('%02d:%02d', $hour, $minute);
                        @endphp
                        <option value="{{ $timeOption }}">
                            {{ $timeOption }}
                        </option>
                    @endfor
                @endfor
            </select>
            <select class="reservation-contents" wire:model="number" name="number" required>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}人</option>
                @endfor
            </select>
        </div>
        <div class="reservation-summary">
            <table>
                <tr><th>Shop</th><td>{{ $shop->name }}</td></tr>
                <tr><th>Date</th><td>{{ $date }}</td></tr>
                <tr><th>Time</th><td>{{ $time }}</td></tr>
                <tr><th>Number</th><td>{{ $number }}人</td></tr>
            </table>
        </div>
        <button class="reservation-button" type="submit">予約する</button>
    </form>
</div>
