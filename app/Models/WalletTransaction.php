<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $table = 'wallet_transactions';

    protected $fillable = ['wallet_id', 'amount', 'type', 'description', 'product_id'];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function product_name()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }
}
