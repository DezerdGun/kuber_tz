<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Balance;
use App\Jobs\ProcessBalanceTransaction;

class ManageBalance extends Command
{
    protected $signature = 'balance:manage {--name=} {--amount=} {--description=}';
    protected $description = 'Начисление или списание средств у пользователя';

    public function handle()
    {
        $name = $this->option('name');
        $amount = floatval($this->option('amount'));
        $description = $this->option('description');

        if (!$name || !$amount || !$description) {
            return $this->error('Укажите --name, --amount и --description');
        }

            $user = User::where('name', $name)->first();
        if (!$user) {
            return $this->error('Пользователь не найден');
        }
        $balance = Balance::where('user_id', $user->id)->first();
        if (!$balance) {
                return $this->error('У пользователя нет баланса');
        }

        if ($balance->amount + $amount < 0) {
            return $this->error('Недостаточно средств для списания');
        }
         ProcessBalanceTransaction::dispatch($user->id, $amount, $description);

        $this->info("Операция по балансу отправлена в очередь.");
    }
}
