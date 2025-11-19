<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ColorModel;

class ColorController extends Controller
{
    public function list()
    {
          $data['meta_title'] = "Color List";
        $data['getRecord'] = ColorModel::getColor();
        return view('backend.color.list', $data);
    }

    public function add()
    {
         $data['meta_title'] = "Add Color";
        return view('backend.color.add', $data);
    }

    public function Store(Request $request)
    {
     
      
        $color = new ColorModel;    
      
        
        $color->name = trim($request->name);
      
        $color->save();

        return redirect('admin/color')->with('success', "Color Successfully saved");
    }

    public function edit($id)
    {
            $data['meta_title'] = "Edit Color";
        $getrecord = ColorModel::get_single($id);
        $data['getrecord'] = $getrecord;
        return view('backend.color.edit',$data);   
    }


    public function Update($id, Request $request)
    {
        
        $color = ColorModel::get_single($id);
       
        
        $color->name = trim($request->name);
        
        $color->save();

        return redirect('admin/color')->with('success', "Color Successfully Update");
    }


    public function Delete($id)
    {
        
       $color = ColorModel::get_single($id)->delete();

        return redirect('admin/color')->with('success', "Color Successfully Delete");
    }

}
