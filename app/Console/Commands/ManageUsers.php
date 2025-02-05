<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;

class ManageUsers extends Command
{
    protected $signature = 'user:manage {action} {--name=} {--password=} {--email=}';

    protected $description = 'Добавление пользователей и операции с балансом';

    public function handle()
    {
        $action = $this->argument('action');

        if ($action === 'add') {
            return $this->addUser();
        } elseif ($action === 'balance') {
            return $this->manageBalance();
        }

        $this->error("Неизвестная команда. Доступные: add, balance");
    }

    private function addUser()
    {
        $name = $this->option('name');
        $password = $this->option('password');
        $email = $this->option('email');

        if (!$name || !$password || !$email) {
            return $this->error('Укажите --name, --password и --email');
        }

        if (User::where('name', $name)->exists()) {
            return $this->error('Пользователь с таким именем уже существует');
        }

        if (User::where('email', $email)->exists()) {
            return $this->error('Пользователь с таким email уже существует');
        }

        User::create([
            'name' => $name,
            'password' => Hash::make($password),
            'email' => $email,
            'balance' => 0
        ]);

        $this->info("Пользователь $name ($email) добавлен.");
    }


    private function manageBalance()
    {
        $name = $this->option('name');
        $amount = $this->option('amount');
        $description = $this->option('description');

        if (!$name || !$amount || !$description) {
            return $this->error('Укажите --name, --amount и --description');
        }

        $user = User::where('name', $name)->first();
        if (!$user) {
            return $this->error('Пользователь не найден');
        }

        $amount = (float) $amount;

        if ($amount < 0 && ($user->balance + $amount) < 0) {
            return $this->error('Нельзя увести баланс в минус');
        }

        $user->balance += $amount;
        $user->save();

        Transaction::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'description' => $description,
        ]);

        $this->info("Баланс пользователя $name изменён на $amount. Новый баланс: {$user->balance}");
    }
}
