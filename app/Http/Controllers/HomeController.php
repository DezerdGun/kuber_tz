<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Получение текущего пользователя
        $balance = $user->balance; // Получение текущего баланса пользователя
        $transactions = $user->transactions()->latest()->take(5)->get(); // Последние 5 операций

        return view('home', compact('balance', 'transactions'));
    }
}
