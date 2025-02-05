@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">История операций</h1>

        <form method="GET" action="{{ route('transactions') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Поиск по описанию" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Поиск</button>
            </div>
        </form>
        <div id="transactions-table">
            @include('transactions._transactions_table', ['transactions' => $transactions])
        </div>
    </div>

    <script>
        function refreshTransactions() {
            fetch('{{ route("transactions.refresh") }}')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('transactions-table').innerHTML = data;
                })
                .catch(error => console.error("Ошибка при обновлении данных:", error));
        }
        setInterval(refreshTransactions, 2000);
    </script>
@endsection
