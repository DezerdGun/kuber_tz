<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::where('user_id', $request->user()->id)
                                    ->orderBy('created_at', 'desc')
                                    ->when($request->search, function($query) use ($request) {
                                        return $query->where('description', 'like', '%' . $request->search . '%');
                                    })
                                    ->get();

        return response()->json($transactions);
    }
}
