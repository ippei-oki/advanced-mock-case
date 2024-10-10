<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRコード確認</title>
</head>
<body>
    <h1>{{ $reservation->shop->name }}の予約確認</h1>
    <p>予約ID: {{ $reservation->id }}</p>
    <p>予約日時: {{ $reservation->date }} {{ $reservation->time }}</p>
    <p>人数: {{ $reservation->number }}名</p>
    <p>この予約が有効です。お待ちしております。</p>
</body>
</html>