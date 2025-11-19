<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\WalletTransaction;
use App\Models\Wallet;
use Auth;

class WithdrawRequestsController extends Controller
{
    public function list(Request $request)
    {
        $data['getRecord'] = Transaction::getRecord($request);
        $data['meta_title'] = "Withdraw Requests List";
        return view('backend.withdraw_requests.list', $data);               
	}

    public function accept($id)
    {
        
        $save = Transaction::find($id);
        $save->type = 2;
        $save->save();

        return redirect()->back()->with('success',"Payment Successfully Withdraw");

    }

    public function add_reason(Request $request)
    {

        $record = Transaction::where('id', '=', trim($request->reason_no))->first();
        $record->reason = $request->reason;
        $record->type = 3;
        $record->save();

        $wallet = Wallet::where('id', '=', $record->wallet_id)->first();
        $wallet->balance += $record->amount;
        $wallet->save();

       // $title = 'Age 18 + ID';
        //$message = 'Your ID has been rejected please upload again.';
        //UserAgeIdModel::sendPushNotificationCutsomer($title,$message,$record->user_id);

        return redirect('admin/withdraw_requests')->with('error', 'Payment Successfully Reject.');    
    }

}