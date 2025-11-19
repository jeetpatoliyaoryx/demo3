<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdatePasswordUser;
use App\Models\User;
use App\Models\CountryModel;
use App\Models\OrdersModel;
use App\Models\UsersWishlistModel;
use App\Models\ProductModel;
// use App\Models\SEOModel;
use Auth;
use Str;
use Image;
use Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function profile()
    {
        // $seo = SEOModel::get_slug('profile');
        // $data['meta_title'] = $seo->meta_title;
        // $data['meta_description'] = $seo->meta_description;
        // $data['meta_canonical'] = url('profile');
        $data['getCountry'] = CountryModel::getCountry();
        $data['user'] = User::get_single(Auth::user()->id);
        $data['meta_title'] = "Profile";
        return view('user.profile', $data);
    }




    public function update_profile(Request $request)
    {

        // $user = request()->validate([
        //     'name'      => 'required',
        //     'email'     => 'required|unique:users,email,'.Auth::user()->id,
        // ]);


        $user = User::get_single(Auth::user()->id);

        if (!empty($request->file('profile_pic'))) {
            if(!empty($user->profile_pic) && file_exists('upload/profile/'.$user->profile_pic)){
                unlink('upload/profile/'.$user->profile_pic);
            }
            $ext            = 'jpg';
            $file           = $request->file('profile_pic');
            $randomStr      = Str::random(30);
            $filename       = $randomStr . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $user->profile_pic = $filename;


            $thumb_img = Image::read('upload/profile/'.$filename)->resize(300, 300);
            $thumb_img->save('upload/profile/' . $filename, 100);

        }
        $user->name         = trim($request->name);
        $user->email         = trim($request->email);
        $user->last_name    = trim($request->last_name);
        $user->phone_number = trim($request->phone_number);
        $user->country_id = trim($request->country_id);
        $user->save();

        return redirect()->back()->with('success', "Your Account Successfully Updated");
    }

     public function orders()
    {

        // $seo = SEOModel::get_slug('orders');
        // $data['meta_title'] = $seo->meta_title;
        // $data['meta_description'] = $seo->meta_description;
        // $data['meta_canonical'] = url('orders');

        $data['meta_title'] = "Order";
        $data['get_order'] = OrdersModel::get_user_order(Auth::user()->id);
        $data['user'] = User::get_single(Auth::user()->id);
        return view('user.orders', $data);
    }


     public function change_password()
    {
        // $seo = SEOModel::get_slug('change-password');
        // $data['meta_title'] = $seo->meta_title;
        // $data['meta_description'] = $seo->meta_description;
        // $data['meta_canonical'] = url('change-password');

        $data['meta_title'] = "Change Password";
        $data['user'] = User::get_single(Auth::user()->id);
        return view('user.change_password', $data);
    }

    public function update_change_password(Request $request)
    {
        $user = User::get_single(Auth::user()->id);

        // Check if new password and confirm password match
        if ($request->new_password !== $request->confirm_password) {
            return redirect()->back()->with('error', 'New Password and Confirm Password do not match!');
        }

        // Check old password
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success', 'Password Successfully Updated!');
        } else {
            return redirect()->back()->with('error', 'Old Password is not correct!');
        }
    }

      public function orders_detail($order_id)
    {
         $data['meta_title'] = "Order Detail";
        $order_id = base64_decode($order_id);
        $get_order = OrdersModel::get_user_order_single($order_id, Auth::user()->id);
        if(!empty($get_order))
        {
            $data['get_order'] = $get_order;
            return view('user.orders_detail', $data);       
        }
        else
        {
            return redirect()->back();
        }        
    }

    
    public function add_remove_wishlist(Request $request)
    {
       $count =  UsersWishlistModel::add_remove($request->product_id, Auth::user()->id);
       if($count == 1)
       {
            $json['html'] = '<i class="icon-heart"></i>';
       }
       else
       {
            $json['html'] = '<i class="icon-heart-o"></i>';
       }
       $json['status'] = $count;
       echo json_encode($json);
    }

    public function wishlist()
    {

        // $seo = SEOModel::get_slug('wishlist');
        // $data['meta_title'] = $seo->meta_title;
        // $data['meta_description'] = $seo->meta_description;
        // $data['meta_canonical'] = url('wishlist');
          $data['meta_title'] = "Wishlist";
        $data['getProduct'] = UsersWishlistModel::getWishlistProduct(Auth::user()->id);
        $data['user'] = User::get_single(Auth::user()->id);
        return view('user.wishlist', $data);
    }

    public function user_bank_detail(Request $request)
    {
            $data['meta_title'] = "Back Detail";
         $data['user'] = User::get_single(Auth::user()->id);
        return view('user.bank_detail', $data);
    }

    public function user_bank_detail_update(Request $request)
    {
        $request->validate([
        
            'pan_card' => ['required', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/'], // PAN pattern
        ], [
            
            'pan_card.regex' => 'Please enter a valid PAN (e.g. ABCDE1234F).',
        ]);
        
        $user = User::get_single(Auth::user()->id);

        // Check if new password and confirm password match
        if ($request->account_number !== $request->confirm_account_number) {
            return redirect()->back()->with('error', 'Account Number and Confirm Account Number do not match!');
        }
        // Check old password
        $user->holder_name = trim($request->holder_name);
        $user->bank_name = trim($request->bank_name);
        $user->ifsc_code = trim($request->ifsc_code);
        $user->account_number = trim($request->account_number);
        $user->confirm_account_number = trim($request->confirm_account_number);
        $user->pan_card = trim($request->pan_card);
        $user->save();
        return redirect()->back()->with('success', 'Bank Detail Updated Successfully!');
        
    }

}