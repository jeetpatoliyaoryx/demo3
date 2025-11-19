<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UsersController extends Controller
{
    public function list(Request $request)
    {
        $data['getRecord'] = User::getAdmin($request);
        $data['meta_title'] = "Users List";
        return view('backend.users.list', $data);               
	}

    public function delete($id, Request $request)
    {
        $save = User::get_single($id);
        $save->is_delete = 1;
        $save->save();
        return redirect()->back()->with('success', 'User successfully deleted');
    }

    public function view($id)
    {
        $data['getRecord'] = User::get_single($id);
        
        $data['meta_title'] = "View Users";
        return view('backend.users.view', $data);      
    }
	
}
