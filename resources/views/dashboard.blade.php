<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Баланс: <span id="balance">{{ $balance }}</span></h1>

    <h2>Последние 5 операций</h2>
    <ul id="transactions">
        @foreach ($transactions as $transaction)
            <li>{{ $transaction->created_at }} - {{ $transaction->description }} - {{ $transaction->amount }}</li>
        @endforeach
    </ul>
</body>
</html>
