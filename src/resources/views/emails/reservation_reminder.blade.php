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
    <p>以下のQRコードを来店時にご提示ください。</p>
    <!-- <img src="{{ $message->embedData(QrCode::format('png')->size(200)->generate(route('reservation.qr', $reservation->id)), 'QrCode.png') }}" alt="QRコード"> -->
    <!-- <img src="{{ $message->embedData(QrCode::format('svg')->size(200)->generate(route('reservation.qr', $reservation->id)), 'QrCode.svg') }}" alt="QRコード"> -->
    <!-- {!! QrCode::format('svg')->size(200)->generate(route('reservation.qr', $reservation->id)) !!} -->
    <!-- <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::format('svg')->size(200)->generate(route('reservation.qr', $reservation->id))) }}" alt="QRコード"> -->
    <img src="{{ $message->embedData($qrCodeSvg, 'QrCode.svg') }}" alt="QRコード">

</body>
</html>
