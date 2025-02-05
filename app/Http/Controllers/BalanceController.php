<?php

namespace App\Http\Controllers;

class BalanceController extends Controller
{

    public function index()
    {
        $user = auth()->user(); // Получение текущего пользователя
        $balance = $user->balance; // Получение текущего баланса пользователя
        $transactions = $user->transactions()->latest()->take(5)->get(); // Последние 5 операций

        return view('home', compact('balance', 'transactions'));
    }
}
