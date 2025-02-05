<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>История операций</title>
</head>
<body>
    <form method="GET" action="{{ route('transactions') }}">
        <input type="text" name="search" placeholder="Поиск по описанию" value="{{ request('search') }}">
        <button type="submit">Поиск</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Дата</th>
                <th>Описание</th>
                <th>Сумма</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->created_at }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td>{{ $transaction->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
