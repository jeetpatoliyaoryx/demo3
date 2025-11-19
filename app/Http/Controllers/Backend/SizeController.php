<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SizeModel;

class SizeController extends Controller
{
    public function list()
    {

         $data['meta_title'] = "Size List";
        $data['getRecord'] = SizeModel::getRecord();
        return view('backend.size.list', $data);
    }

    public function add()
    {
         $data['meta_title'] = "Add Size";
        return view('backend.size.add', $data);
    }

    public function Store(Request $request)
    {
   
        $size = new SizeModel;    
        $size->name = trim($request->name);
        $size->save();

        return redirect('admin/size')->with('success', "Size Successfully saved");
    }

    public function edit($id)
    {
           $data['meta_title'] = "Edit Size";
        $getrecord = SizeModel::get_single($id);
        $data['getrecord'] = $getrecord;
        return view('backend.size.edit',$data);   
    }

    public function Update($id, Request $request)
    {
        $size = SizeModel::get_single($id);
       
        $size->name = trim($request->name);
       
        $size->save();

        return redirect('admin/size')->with('success', "Size Successfully Update");
    }

    public function delete($id)
    {
        $size = SizeModel::get_single($id)->delete();
       

        return redirect('admin/size')->with('success', "Size Successfully Delete");
    }
}
