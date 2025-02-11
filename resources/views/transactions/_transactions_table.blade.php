<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
        <tr>
            <th>Data</th>
            <th>Descr</th>
            <th>Sum</th>
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
</div>
