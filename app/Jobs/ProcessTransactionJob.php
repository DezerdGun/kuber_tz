<?php

namespace App\Jobs;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $amount;
    protected $type;
    protected $description;

    public function __construct($user, $amount, $type, $description)
    {
        $this->user = $user;
        $this->amount = $amount;
        $this->type = $type;
        $this->description = $description;
    }

    public function handle()
    {
        // Логика обработки транзакции
        $user = User::find($this->user);
        if ($this->type === 'deposit') {
            $user->balance += $this->amount;
        } elseif ($this->type === 'withdraw') {
            if ($user->balance >= $this->amount) {
                $user->balance -= $this->amount;
            } else {
                // Обработка ошибки, если недостаточно средств
            }
        }

        // Сохранение обновленного баланса
        $user->save();

        // Добавление операции
        Transaction::create([
            'user_id' => $user->id,
            'amount' => $this->amount,
            'type' => $this->type,
            'description' => $this->description,
        ]);
    }
}
