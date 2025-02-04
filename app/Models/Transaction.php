<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'amount', 'description', 'transaction_type',
    ];
    const TYPE_CREDIT = 'credit';
    const TYPE_DEBIT = 'debit';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
