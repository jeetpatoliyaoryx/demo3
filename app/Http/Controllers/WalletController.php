<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Transaction;
use Auth;

class WalletController extends Controller
{
    public function index()
    {
        $meta_title = "Wallet";
        $wallet = Wallet::firstOrCreate(['user_id'=>Auth::id()],['balance'=>0]);
        $transactions = $wallet->transactions()->latest()->get();
        return view('user.wallet',compact('wallet','transactions','meta_title'));
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $wallet = Wallet::firstOrCreate(
            ['user_id' => Auth::id()],
            ['balance' => 0]
        );

        if ($request->amount > $wallet->balance) {
            return back()->with('error', 'Insufficient balance for withdrawal.');
        }

        // Deduct amount
        $wallet->balance -= $request->amount;
        $wallet->save();

        // Save transaction
        $wallet->transactions_table()->create([
            'user_id' => Auth::id(),
            'type' => 1,
            'amount' => $request->amount,
            'product_name_id' => null, // set if linked to product, else null
        ]);


        return back()->with('success', 'Withdrawal request submitted successfully.');
    }
    
    public function withdraw_history(Request $request)
    {
         $data['meta_title'] = "Withdraw History";
       $data['getRecord'] = Transaction::where('user_id', '=', Auth::user()->id)->get();
       return view('user.withdraw_history', $data);
    }
}
