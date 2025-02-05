<?php

namespace App\Http\Controllers;

class BalanceController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $balance = $user->balance;
        $transactions = $user->transactions()->latest()->take(5)->get();


        return view('home', compact('balance', 'transactions'));
    }
}
