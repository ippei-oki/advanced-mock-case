<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約リマインダー</title>
</head>
<body>
    <p>{{ $reservation->user->name }}様</p>
    <p>以下の内容でご予約がございます。</p>
    <p>店舗名: {{ $reservation->shop->name }}</p>
    <p>予約日時: {{ $reservation->date }} {{ $reservation->time }}</p>
    <p>人数: {{ $reservation->number }}名</p>
    <p>お待ちしております。</p>
</body>
</html>
