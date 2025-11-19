<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdersModel;
use App\Models\ProductModel;
use App\Models\OrdersItemModel;
use App\Models\CountryModel;
use App\Models\ReferralCode;
use App\Models\User;
use Auth;

class ReferralOrdersController extends Controller
{

	public function referral_orders(Request $request)
    {
          $data['meta_title'] = "Referral Orders";
        $data['getRecord'] = OrdersItemModel::get_user_order_item(Auth::user()->id);
        $data['user'] = User::get_single(Auth::user()->id);
        return view('user.referral_orders', $data);
    }

    public function referral_orders_details($id, Request $request)
    {
    	$data['getRecord'] = OrdersItemModel::get_user_order_item_single($id);
        $data['meta_title'] = "Referral Orders Details";
    	return view('user.referral_orders_details',$data);
    }

}