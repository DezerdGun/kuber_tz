<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $balance = $user->balance;
        $transactions = $user->transactions()->latest()->take(5)->get();

        return view('dashboard', compact('balance', 'transactions'));
    }

    public function transactions(Request $request)
    {
        $transactions = Transaction::orderBy('created_at', 'desc')
            ->when($request->search, function($query) use ($request) {
                return $query->where('description', 'like', '%' . $request->search . '%');
            })
            ->get();

        return view('transaction', compact('transactions'));
    }
}
