<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'wallet_id',
        'user_id',
        'type',
        'amount',
        'product_name_id'
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function product_name()
    {
        return $this->belongsTo(Product::class, 'product_name_id');
    }

    static public function getRecord($request)
    {
        //return self::orderBy('id','desc')->paginate(25);
        return Transaction::select('transactions.*', 'users.name')
                ->join('users','users.id','=','transactions.user_id')
                ->orderBy('transactions.id','desc')
                ->paginate(16);
    }


}
