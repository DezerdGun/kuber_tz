<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $balance = $user->balance;
        $transactions = $user->transactions()->latest()->take(5)->get();

        return response()->json([
            'balance' => $balance,
            'transactions' => $transactions,
        ]);
    }
}
