<!-- resources/views/home.blade.php -->

<h1>Добро пожаловать, {{ auth()->user()->name }}</h1>

<h2>Текущий баланс: {{ $balance }}</h2>

<h3>Последние 5 операций:</h3>
<ul>
    @foreach ($transactions as $transaction)
        <li>{{ $transaction->description }} - {{ $transaction->amount }} - {{ $transaction->created_at }}</li>
    @endforeach
</ul>
