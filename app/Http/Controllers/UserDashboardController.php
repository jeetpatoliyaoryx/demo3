<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use App\Models\OrdersModel;
// use App\Models\SEOModel;
use Auth;

class UserDashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        // $seo = SEOModel::get_slug('dashboard');
        // $data['meta_title'] = $seo->meta_title;
        // $data['meta_description'] = $seo->meta_description;
        // $data['meta_canonical'] = url('dashboard');

        // $data['get_order'] = OrdersModel::get_user_order_uncompleted(Auth::user()->id);
        // $data['TotalOrder'] = OrdersModel::get_user_order_count(Auth::user()->id);
        $data['meta_title'] = "Dashboard";
        $data['user'] = User::get_single(Auth::user()->id);
        return view('user.dashboard', $data);
    }
}
