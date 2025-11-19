<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OrdersModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Auth;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {

        $data['TotalUser'] = User::where('is_admin', '=', 0)->where('is_delete', '=', 0)->count();
        $data['TotalActiveUser'] = User::where('is_admin', '=', 0)->where('is_delete', '=', 0)->where('status', '=', 1)->count();
        $data['TotalProducts'] =  ProductModel::where('is_delete', '=', 0)->count();
        $data['TotalOrder'] = OrdersModel::where('is_delete', '=', 0)->count();

        $data['meta_title'] = "Dashboard";
        return view('backend.dashboard.list', $data);               
	}
	

}


