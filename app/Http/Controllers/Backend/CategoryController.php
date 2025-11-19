<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\CategoryModel;
use Str;
class CategoryController extends Controller
{
    public function list()
    {
        // $categorys = CategoryModel::all();
        // foreach($categorys as $category)
        // {
        //     $slug   = Str::slug($category->name, '-');
        //     $getSlug  = CategoryModel::getSlug($slug);
        //     if(!empty($getSlug))
        //     {
        //         $slug = $slug.'-'.$category->id;
        //     }
        //     $category->slug = $slug;
        //     $category->save();
        // }
        

        $data['meta_title'] = "Category";
        $data['getParentCategory'] = CategoryModel::getParentCategory(0);
        return view('backend.category.list',$data);
    }

    public function add()
    {
        $data['meta_title'] = "Add Category";
        $data['getParentCategory'] = CategoryModel::getParentCategoryAdmin(0);
        return view('backend.category.add',$data);
    }

    public function PostCategory(Request $request)
    {
        $parent_id = 0;
        if(!empty($request->parent_id))
        {
            if(count($request->parent_id) == 1)
            {
                $parent_id = !empty($request->parent_id['0']) ? $request->parent_id['0'] : 0;
            }
            else
            {
                $array_filter = array_filter($request->parent_id);

                $parent_id = !empty(last($array_filter)) ? last($array_filter) : 0;
            }
        }
        
        $category = new CategoryModel;
        $category->parent_id = $parent_id;
        $category->name = trim($request->name);
        $category->status = trim($request->status);
        
        if(!empty($request->file('category_image'))){
            if(!empty($category->category_image) && file_exists('upload/category_image/'.$category->category_image)){
                unlink('upload/category_image/'.$category->category_image);
            }

            $file = $request->file('category_image');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/category_image/',$filename);
            $category->category_image = $filename;
        }

          if(!empty($request->file('category_banner_image'))){
            if(!empty($category->category_banner_image) && file_exists('upload/category_image/'.$category->category_banner_image)){
                unlink('upload/category_image/'.$category->category_banner_image);
            }

            $file = $request->file('category_banner_image');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/category_image/',$filename);
            $category->category_banner_image = $filename;
        }



        $category->save();

        $slug   = Str::slug($request->name, '-');
        $getSlug  = CategoryModel::getSlug($slug);
        if(!empty($getSlug))
        {
            $slug = $slug.'-'.$category->id;
        }

        $category->slug = trim($slug);
        $category->save();
        
        // return redirect('admin/category')->with('success', "Category Successfully saved");
        return redirect()->back()->with('success', "Category Successfully saved");
    }

    public function edit($id)
    {
        $data['meta_title'] = "Edit Category";
        $data['getParentCategory'] = CategoryModel::getParentCategory(0);
        $getrecord = CategoryModel::get_single($id);
        $data['getrecord'] = $getrecord;
        return view('backend.category.edit',$data);   
    }

    public function post_edit($id, Request $request)
    {   
        $category         = CategoryModel::get_single($id);
        $category->name   = trim($request->name);
        $category->status = trim($request->status);

        if ($request->has('status')) {
           $this->updateChildStatus($category->id, $request->status);
        }

     
        if(!empty($request->file('category_image'))){
            if(!empty($category->category_image) && file_exists('upload/category_image/'.$category->category_image)){
                unlink('upload/category_image/'.$category->category_image);
            }

            $file = $request->file('category_image');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/category_image/',$filename);
            $category->category_image = $filename;
        }

        if(!empty($request->file('category_banner_image'))){
            if(!empty($category->category_banner_image) && file_exists('upload/category_image/'.$category->category_banner_image)){
                unlink('upload/category_image/'.$category->category_banner_image);
            }

            $file = $request->file('category_banner_image');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/category_image/',$filename);
            $category->category_banner_image = $filename;
        }


        $category->save();

        return redirect('admin/category')->with('success', "Category Successfully update");
    }

    private function updateChildStatus($parentId, $status)
    {
        $children = CategoryModel::where('parent_id', $parentId)->get();

        foreach ($children as $child) {
            $child->status = $status;
            $child->save();

            $this->updateChildStatus($child->id, $status);
        }
    }


    public function getParent(Request $request)
    {
        $getParentCategory = CategoryModel::getParentCategory($request->parent_id);
        if($getParentCategory->count() > 0)
        {
            $html = '';
            $html .= '<div style="margin-bottom: 5px;">
                      <select class="form-control SubParentCategory"  name="parent_id[]">
                          <option value="">None</option>';
                        foreach ($getParentCategory as $key => $value) 
                        {
                            $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
                        }   
                      $html .= '</select>
                   </div><div id="appendSubCategory"></div>';

           $json['success'] = $html;    
        }
        else
        {
          $json['success'] = 0;       
        }
        
       echo json_encode($json);
    }

    public function getSubParent(Request $request)
    {
        $getParentCategory = CategoryModel::getParentCategory($request->parent_id);
        if($getParentCategory->count() > 0)
        {
            $html = '';
            $html .= '<div style="margin-bottom: 5px;">
                      <select class="form-control"  name="parent_id[]">
                          <option value="">None</option>';
                        foreach ($getParentCategory as $key => $value) 
                        {
                            $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
                        }   
                      $html .= '</select>
                   </div>';

           $json['success'] = $html;
          
        }
        else
        {
          $json['success'] = 0;       
        }

         echo json_encode($json);
    }

    
}
