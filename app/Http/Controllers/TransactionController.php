<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $balance = $user->balance;

        $transactionsQuery = $user->transactions()->orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $transactionsQuery->where('description', 'like', '%' . $request->search . '%');
        } else {
            $transactionsQuery->take(5);
        }

        $transactions = $transactionsQuery->get();

        return view('transaction', compact('balance', 'transactions')); // Без папки
    }

    public function refresh(Request $request)
    {
        $search = $request->get('search');

        $query = Transaction::query();
        if ($search) {
            $query->where('description', 'like', '%' . $search . '%');
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();

        return view('transactions._transactions_table', compact('transactions'));
    }

}
