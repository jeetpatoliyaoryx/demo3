<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets';
    protected $fillable = ['user_id', 'balance'];

    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class, 'wallet_id');
    }
     public function transactions_table()
    {
      return $this->hasMany(Transaction::class, 'wallet_id', 'id');
    }
}
