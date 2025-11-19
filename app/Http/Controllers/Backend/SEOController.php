<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SEOModel;

class SEOController extends Controller
{
    public function list()
    {
        $data['getRecord'] = SEOModel::getRecord();
         $data['meta_title'] = "SEO List";
        return view('backend.seo.list', $data);
    }

    public function add()
    {
        $data['meta_title'] = "Add SEO";
        return view('backend.seo.add', $data);
    }

    public function store(Request $request)
    {
        request()->validate([
           'slug'  => 'required|unique:seo',
        ]); 

        $seo = new SEOModel;    
        $seo->slug = trim($request->slug);
        $seo->name = trim($request->name);
        $seo->meta_title = trim($request->meta_title);
        $seo->meta_description = trim($request->meta_description);
        $seo->save();
    

        return redirect('admin/seo')->with('success', "SEO Successfully Saved");
    }

     public function edit($id)
    {
        $data['getrecord'] = SEOModel::get_single($id);
        $data['meta_title'] = "Edit SEO";
        return view('backend.seo.edit',$data);   
    }

    public function update($id, Request $request)
    {
        request()->validate([
           'slug'  => 'required|unique:seo,slug,'.$id,
        ]);

        $seo = SEOModel::get_single($id);
        $seo->slug = trim($request->slug);
        $seo->name = trim($request->name);
        $seo->meta_title = trim($request->meta_title);
        $seo->meta_description = trim($request->meta_description);
        $seo->save();
    

        return redirect('admin/seo')->with('success', "SEO Successfully Update");
    }

}
