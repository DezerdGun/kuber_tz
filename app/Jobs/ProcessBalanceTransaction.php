<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Balance;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessBalanceTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    protected $amount;
    protected $description;

    public function __construct($userId, $amount, $description)
    {
        $this->userId = $userId;
        $this->amount = $amount;
        $this->description = $description;
    }

    public function handle()
    {
        $user = User::find($this->userId);
        if (!$user) {
            Log::error("Error: User with ID {$this->userId} not found.");
            return;
        }

        $balance = Balance::where('user_id', $user->id)->first();
        if (!$balance) {
            Log::error("Error: Баланс пользователя не найден.");
            return;
        }

        if ($balance->amount + $this->amount < 0) {
            Log::error("Error: Not enough у {$user->name}.");
            return;
        }
        $balance->amount += $this->amount;
        $balance->save();
        Transaction::create([
            'user_id' => $user->id,
            'amount' => $this->amount,
            'description' => $this->description,
        ]);

        Log::info("Баланс пользователя {$user->name} изменён на {$this->amount}. Описание: {$this->description}");
    }
}
