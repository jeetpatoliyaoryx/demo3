<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\CatalogueModel;
use App\Models\CatalogueProductModel;
use App\Models\ProductModel;
use Str;
use File;

class CatalogueController extends Controller
{
    public function list()
    {
        $data['getRecord'] = CatalogueModel::get();
        $data['meta_title'] = "Catalogue List";
        return view('backend.catalogue.list', $data);         
    }
    public function add()
    {
    	$data['meta_title'] = "Add Catalogue";
        $data['ProductCatalogue'] = ProductModel::ProductCatalogue();
        return view('backend.catalogue.add', $data);      
    }

    public function store(Request $request)
    {
    	$category = new CatalogueModel;
    	$category->catalogue_name = trim($request->catalogue_name);
    	if(!empty($request->file('catalogue_image'))){
            if(!empty($category->catalogue_image) && file_exists('upload/catalogue/'.$category->catalogue_image)){
                unlink('upload/catalogue/'.$category->catalogue_image);
            }

            $file = $request->file('catalogue_image');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/catalogue/',$filename);
            $category->catalogue_image = $filename;
        }

        


        $category->save();

        if(!empty($request->product_id))
        {
            $product_id = $request->product_id; 
            foreach($product_id as $value)
            { 
                $record_new = new CatalogueProductModel;
                $record_new->product_id = $value;
                $record_new->catalogue_id  = $category->id;
              
               $record_new->save();
            }
        }

       
        return redirect('admin/catalogue')->with('success', "Record Successfully Create");
    }

    public function edit($id)
    {
    	$data['editRecord'] = CatalogueModel::get_single($id);
        $data['ProductCatalogue'] = ProductModel::ProductCatalogue();
        $data['selectedProducts'] = CatalogueProductModel::where('catalogue_id', $id)
                                ->pluck('product_id')
                                ->toArray();
    	$data['meta_title'] = "Edit Catalogue";
        return view('backend.catalogue.edit', $data);   
    }

    public function update($id, Request $request)
    {
    	$category = CatalogueModel::get_single($id);
    	$category->catalogue_name = trim($request->catalogue_name);
    	if(!empty($request->file('catalogue_image'))){
            if(!empty($category->catalogue_image) && file_exists('upload/catalogue/'.$category->catalogue_image)){
                unlink('upload/catalogue/'.$category->catalogue_image);
            }

            $file = $request->file('catalogue_image');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/catalogue/',$filename);
            $category->catalogue_image = $filename;
        }

        $category->save();

        CatalogueProductModel::where('catalogue_id', $id)->delete(); 

        //$product_id = explode(",", $product_id);

        if(!empty($request->product_id))
        {
            $product_id = $request->product_id; 
            foreach($product_id as $value)
            { 
                $record_new = new CatalogueProductModel;
                $record_new->product_id = $value;
                $record_new->catalogue_id  = $category->id;
              
               $record_new->save();
            }
        }

        return redirect('admin/catalogue')->with('success', "Record Successfully Update");
    }

    public function delete($id)
    {

        $deleteRecord = CatalogueModel::get_single($id);
        $deleteRecord->delete();

        CatalogueProductModel::where('catalogue_product.catalogue_id','=',$id)->delete();

        return redirect()->back()->with('error', 'Record successfully deleted!');
   
    }
}