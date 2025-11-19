<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmailSubscribeModel;
use App\Mail\ForgotPasswordMail;
use Mail;
use Auth;
use Hash;
use Str;
use Session;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
     public function login() {
        // if (Auth::check()) {
        //     return redirect('user/dashboard');
        // }

        // $seo = SEOModel::get_slug('login');
        // $data['meta_title'] = $seo->meta_title;
        // $data['meta_description'] = $seo->meta_description;
        // $data['meta_canonical'] = url('login');
         $data['meta_title'] = "Login";
        return view('auth.login', $data);
    }

      public function auth_login(Request $request) {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_delete' => '0'], true)) {
            if (!empty(Auth::user()->status)) 
            {
                if (Auth::user()->is_admin == 1) {
                    return redirect()->intended('admin/dashboard');
                } else {
                    return redirect()->intended('user/profile');
                }
            } 
            else 
            {
                // $user_id = Auth::user()->id;
                Auth::logout();
                // $user = User::find($user_id);
                //Mail::to($user->email)->send(new RegisterMail($user));
                return redirect()->back()->with('error', 'This email is not verified yet, please check your inbox to activate your account.');
            }
        } else {
            return redirect()->back()->with('error', 'Please enter the correct credentials');
        }
        
    }
    public function register()
    {
        // if (Auth::check()) {
        //     return redirect('user/dashboard');
        // }

        // $seo = SEOModel::get_slug('register');
        // $data['meta_title'] = $seo->meta_title;
        // $data['meta_description'] = $seo->meta_description;
        // $data['meta_canonical'] = url('register');
        $data['meta_title'] = "Register";
        return view('auth.register', $data);   
    }



    public function PostRegister(Request $request)
    {
        
        $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed', // 'confirmed' checks against 'password_confirmation'
       // 'agree_checkbox' => 'accepted',
        ]);

        $user = new User;
        $user->name = trim($request->first_name);
        $user->last_name = trim($request->last_name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(50); 
        $user->is_admin = 0;
        $user->status = 1;   
        $user->save();

      //  Mail::to($user->email)->send(new UserRegister($user));
        return redirect('login')->with('success', 'Your Account has been created successfully...');
    }


    public function forgot_password()
    {
        // $seo = SEOModel::get_slug('forgot-password');
        // $data['meta_title'] = $seo->meta_title;
        // $data['meta_description'] = $seo->meta_description;
        // $data['meta_canonical'] = url('forgot-password');
        
        return view('auth.forgot_password');   
    }

    public function forgotpassword_check(Request $request) {
        $count = User::where('email', '=', $request->email)->count();
        if ($count > 0) {
            $user = User::where('email', '=', $request->email)->first();
            $user->remember_token = Str::random(50);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success', 'Password has been reset. and sent to you mailbox');

        } else {
            return redirect()->back()->with('error', 'Email not found in the system.');
        }
    }



    public function reset_password($token)
    {
        if (Auth::check()) {
            return redirect('user/dashboard');
        }

        $user = User::where('remember_token', '=', $token)->first();
        if (empty($user)) {
            abort(404);
        }

        // $seo = SEOModel::get_slug('reset-password');
        // $data['meta_title'] = $seo->meta_title;
        // $data['meta_description'] = $seo->meta_description;
        // $data['meta_canonical'] = url('reset-password');

        $data['token'] = $token;
        return view('auth.reset_password', $data);   
    }


    public function postReset($token, Request $request) {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            ]);

        $user = User::where('remember_token', '=', $token)->first();
        if (empty($user)) {
            abort(404);
        }
        $user->password  = Hash::make($request->password);
        $user->remember_token = Str::random(50);
        $user->status = 1;
        $user->is_delete = 0;
        $user->save();
        return redirect('login')->with('success', 'Password has been reset.');
    }

   public function close_subscribe_email(Request $request)
    {
        Session::put('is_newspopup_hide', 1);

        return response()->json([
            'status' => true
        ]);
    }

public function submit_subscribe_email(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Please enter a valid email address.'
        ]);
    }

    // Check if email already exists
    $exists = EmailSubscribeModel::where('email', $request->email)->first();

    if ($exists) {
        return response()->json([
            'status' => false,
            'message' => 'This email is already subscribed!'
        ]);
    }

    // Save new email
    $save = new EmailSubscribeModel;
    $save->email = $request->email;
    $save->save();

    // Hide popup after success
    Session::put('is_newspopup_hide', 1);

    return response()->json([
        'status' => true,
        'id' => base64_encode($save->id),
        'message' => 'Thank you for subscribing!.'
    ]);
}


	public function logout(Request $request)
    {
        Auth::logout();
        return redirect(url('/'));
    }
}