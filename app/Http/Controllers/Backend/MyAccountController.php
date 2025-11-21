<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\ContactSettingModel;
use App\Models\HeaderModel;
use App\Models\FooterModel;
use Hash;
use Str;

class MyAccountController extends Controller
{
    public function list()
    {
        $data['meta_title'] = "My Account";
        $data['getRecord'] = User::find(Auth::user()->id);
        return view('backend.my_account.update', $data);
    }

    public function update_account(Request $request)
    {
        $use = request()->validate([
            'email' => 'required|unique:users,email,' . Auth::user()->id
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);

        if (!empty($request->file('profile_pic'))) {
            if (!empty($user->profile_pic) && file_exists('upload/profile/' . $user->profile_pic)) {
                unlink('upload/profile/' . $user->profile_pic);
            }

            $file = $request->file('profile_pic');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('upload/profile/', $filename);
            $user->profile_pic = $filename;
        }

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect('admin/my_account')->with('success', 'My Account successfully update!!!');
    }

    public function contact_setting(Request $request)
    {
        $data['getRecord'] = ContactSettingModel::first();
        $data['meta_title'] = "Contact Setting";
        return view('backend.contact_setting.update', $data);
    }

    public function update_contact_setting(Request $request)
    {

        $user = ContactSettingModel::first();
        $user->map_link = trim($request->map_link);
        $user->title = trim($request->title);
        $user->sub_title = trim($request->sub_title);
        $user->information = trim($request->information);
        $user->phone = trim($request->phone);
        $user->phone_number = trim($request->phone_number);
        $user->email = trim($request->email);
        $user->email_id = trim($request->email_id);
        $user->address = trim($request->address);
        $user->address_full = trim($request->address_full);
        $user->open_time = trim($request->open_time);
        $user->open_time_1 = trim($request->open_time_1);
        $user->open_time_2 = trim($request->open_time_2);
        $user->save();

        return redirect('admin/contact_setting')->with('success', 'Record successfully update!!!');
    }


    public function header(Request $request)
    {
        $data['getRecord'] = HeaderModel::first();
        $data['meta_title'] = "Header";
        return view('backend.header.update', $data);
    }

    public function update_header(Request $request)
    {
        $user = HeaderModel::first();
        $user->title = trim($request->title);
        $user->sub_title = trim($request->sub_title);

        if (!empty($request->file('logo'))) {
            if (!empty($user->logo) && file_exists('upload/profile/' . $user->logo)) {
                unlink('upload/profile/' . $user->logo);
            }

            $file = $request->file('logo');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('upload/profile/', $filename);
            $user->logo = $filename;
        }



        if (!empty($request->file('favicon_icon'))) {
            if (!empty($user->favicon_icon) && file_exists('upload/profile/' . $user->favicon_icon)) {
                unlink('upload/profile/' . $user->favicon_icon);
            }

            $file = $request->file('favicon_icon');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('upload/profile/', $filename);
            $user->favicon_icon = $filename;
        }
        $user->save();
        return redirect('admin/header')->with('success', 'Record successfully update!!!');
    }

    public function footer(Request $request)
    {
        $data['getRecord'] = FooterModel::first();
        $data['meta_title'] = "Footer";
        return view('backend.footer.update', $data);
    }

    public function update_footer(Request $request)
    {
        
        $user = FooterModel::first();
        $user->infomation = trim($request->infomation);
        $user->home = trim($request->home);
        $user->about_us = trim($request->about_us);
        $user->contact_us = trim($request->contact_us);
        $user->customer_services = trim($request->customer_services);
        $user->shipping_policy = trim($request->shipping_policy);
        $user->return_policy = trim($request->return_policy);
        $user->privacy = trim($request->privacy);
        $user->terms = trim($request->terms);
        $user->cancellation_policy = trim($request->cancellation_policy);
        $user->newletter = trim($request->newletter);
        $user->newletter_d = trim($request->newletter_d);

        $user->facebook_link = trim($request->facebook_link);
        $user->instagram_link = trim($request->instagram_link);

        $user->save();
        return redirect('admin/footer')->with('success', 'Record successfully update!!!');
    }



}