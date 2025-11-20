<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SizeGuideModel;
use Illuminate\Http\Request;
use Str;

class SizeGuideController extends Controller
{
    public function size_guide_list()
    {
        $data['getRecord'] = SizeGuideModel::get();
        $data['meta_title'] = "SizeGuide List";
        return view('backend.size_guide.list', $data);
    }

    public function add_size_guide()
    {
        $data['meta_title'] = "Add SizeGuide";
        return view('backend.size_guide.add', $data);
    }

    public function add_size_guide_store(Request $request)
    {
        $sizeGuide = new SizeGuideModel();

        if (!empty($request->file('image'))) {
            if (!empty($sizeGuide->image) && file_exists('upload/size_guide/' . $sizeGuide->image)) {
                unlink('upload/size_guide/' . $sizeGuide->image);
            }

            $file = $request->file('image');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('upload/size_guide/', $filename);
            $sizeGuide->image = $filename;
        }

        $sizeGuide->save();

        return redirect('admin/size_guide')->with('success', "Record Successfully Create");
    }

    public function edit_size_guide($id)
    {
        $getrecord = SizeGuideModel::get_single($id);
        $data['getrecord'] = $getrecord;
        $data['meta_title'] = "Edit Size Guide";
        return view('backend.size_guide.edit', $data);
    }

    public function edit_size_guide_update($id, Request $request)
    {
        $sizeGuide = SizeGuideModel::get_single($id);

        if (!empty($request->file('image'))) {
            if (!empty($category->image) && file_exists('upload/size_guide/' . $sizeGuide->image)) {
                unlink('upload/size_guide/' . $sizeGuide->image);
            }

            $file = $request->file('image');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('upload/size_guide/', $filename);
            $sizeGuide->image = $filename;
        }
        $sizeGuide->save();

        return redirect('admin/size_guide')->with('success', "Record Successfully Update");
    }

    public function size_guide_delete($id)
    {
        $save = SizeGuideModel::get_single($id)->delete();

        return redirect()->back()->with('success', 'Record successfully deleted');
    }










}
