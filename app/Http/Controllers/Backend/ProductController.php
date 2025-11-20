<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SizeGuideModel;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SizeModel;
use App\Models\ColorModel;
use App\Models\ProductColorModel;
use App\Models\ProductSizeModel;
use App\Models\ProductImageModel;
use App\Models\ContactUsModel;
use Auth;
use Image;
use File;
use Str;

class ProductController extends Controller
{
    public function list(Request $request)
    {
        $data['getRecord'] = ProductModel::getRecord($request);
        $data['meta_title'] = "Product List";
        return view('backend.product.list', $data);
    }

    public function add(Request $request)
    {
        $data['meta_title'] = "Product";
        return view('backend.product.add', $data);
    }


    public function PostProduct(Request $request)
    {
        $title = trim($request->title);

        $product = new ProductModel;
        $product->title = $title;
        $product->is_public = 1;
        $product->save();

        $slug = Str::slug($title, '-');
        $getSlug = ProductModel::getSlug($slug);
        if (!empty($getSlug)) {
            $slug = $slug . '-' . $product->id;
        }

        $product->slug = $slug;
        $product->save();

        return redirect('admin/product/edit/' . $product->id)->with('success', "Product Successfully saved");
    }

    public function edit($id)
    {
        $data['getParentCategory'] = CategoryModel::getHomeCategory(0);
        $data['getSize'] = SizeModel::getSize();
        $data['getColor'] = ColorModel::getColorHome();
        $product = ProductModel::get_single($id);
        $data['product'] = $product;

        $data['getcolorproduct'] = ProductColorModel::getRecord($id);
        $data['getsizeproduct'] = ProductSizeModel::getRecord($id);

        $first_category = 0;
        $second_category = 0;
        $last_category = 0;
        if (!empty($product->category_id)) {
            $getAllCategory = CategoryModel::getAllCategory($product->category_id);
            $first_category = !empty($getAllCategory[0]) ? $getAllCategory[0] : 0;
            $second_category = !empty($getAllCategory[1]) ? $getAllCategory[1] : 0;
            $last_category = !empty($getAllCategory[2]) ? $getAllCategory[2] : 0;

        }

        $data['first_category'] = $first_category;
        $data['scond_category'] = $second_category;
        $data['last_category'] = $last_category;
        $data['meta_title'] = "Product";
        $data['getSizeGuide'] = SizeGuideModel::get();

        $data['selectedSizeGuides'] = [];
        if (!empty($product->size_guide_id)) {
            $data['selectedSizeGuides'] = explode(',', $product->size_guide_id);
        }

        return view('backend.product.edit', $data);
    }

    public function getParent(Request $request)
    {
        $getParentCategory = CategoryModel::getHomeCategory($request->parent_id);
        if ($getParentCategory->count() > 0) {
            $html = '';
            $html .= '<div style="margin-bottom: 5px;">
                      <select class="form-control SubParentCategory" required  name="parent_id[]">
                          <option value="">Select</option>';
            foreach ($getParentCategory as $key => $value) {
                $selected = '';
                if ($request->scond_category == $value->id) {
                    $selected = 'selected';
                }
                $html .= '<option ' . $selected . ' value="' . $value->id . '">' . $value->name . '</option>';
            }
            $html .= '</select>
                   </div><div id="appendSubCategory"></div>';

            $json['success'] = $html;
        } else {
            $json['success'] = 0;
        }

        echo json_encode($json);
    }

    public function UpdateProduct($id, Request $request)
    {
        $product = ProductModel::get_single($id);

        $category_id = 0;
        if (!empty($request->parent_id)) {
            if (count($request->parent_id) == 1) {
                $category_id = $request->parent_id[0] ?? 0;
            } else {
                $array_filter = array_filter($request->parent_id);
                $category_id = last($array_filter) ?? 0;
            }
        }

        if ($request->delete_video == 1) {
            $oldPath = 'upload/' . $product->id . '/' . $product->video_file;

            if (!empty($product->video_file) && file_exists($oldPath)) {
                unlink($oldPath);
            }

            $product->video_file = null;
        }

        if ($request->hasFile('video_file')) {
            $oldPath = 'upload/' . $product->id . '/' . $product->video_file;

            if (!empty($product->video_file) && file_exists($oldPath)) {
                unlink($oldPath);
            }

            $file = $request->file('video_file');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('upload/' . $product->id . '/', $filename);

            $product->video_file = $filename;
        }

        $product->title = trim($request->title);
        $product->sku = $request->sku;
        $product->total_product = $request->total_product;
        $product->old_price = $request->old_price;
        $product->price = $request->price;
        $product->purchase_price = $request->purchase_price;
        $product->referral_price = $request->referral_price;
        $product->description = $request->description;
        $product->title_description = $request->title_description;

        $product->is_public = $request->is_public;
        $product->category_id = $category_id;
        $product->is_featured = !empty($request->is_featured) ? 1 : 0;
        $product->is_new_arrival = !empty($request->is_new_arrival) ? 1 : 0;
        $product->is_best_selling = !empty($request->is_best_selling) ? 1 : 0;


        if (!empty($request->size_guide_ids)) {
            $product->size_guide_id = implode(',', $request->size_guide_ids);
        } else {
            $product->size_guide_id = null;
        }


        $product->save();


        if ($request->type_message == 1) {
            return redirect('admin/product')->with('success', "Product Updated Successfully");
        } else {
            return redirect('admin/product')->with('success', "Product Added Successfully");
        }
    }




    public function getSubParent(Request $request)
    {
        $getParentCategory = CategoryModel::getHomeCategory($request->parent_id);
        if ($getParentCategory->count() > 0) {
            $html = '';
            $html .= '<div style="margin-bottom: 5px;">
                      <select class="form-control" required name="parent_id[]">
                          <option value="">Select</option>';
            foreach ($getParentCategory as $key => $value) {
                $selected = '';
                if ($request->last_category == $value->id) {
                    $selected = 'selected';
                }
                $html .= '<option ' . $selected . ' value="' . $value->id . '">' . $value->name . '</option>';
            }
            $html .= '</select>
                   </div>';

            $json['success'] = $html;

        } else {
            $json['success'] = 0;
        }

        echo json_encode($json);
    }


    public function addcolorajax(Request $request)
    {

        $color = new ProductColorModel;
        $color->name = trim(ucwords($request->value));
        $color->product_id = trim($request->id);
        $color->color_code = trim($request->color_code);
        $color->save();


        $getcolorproduct = ProductColorModel::getRecord($request->id);

        return response()->json([
            "status" => true,
            "items" => view("backend.product.parts._color", [
                "getcolorproduct" => $getcolorproduct,
            ])->render(),
        ], 200);
    }

    public function addsizeajax(Request $request)
    {
        $size = new ProductSizeModel;
        $size->name = trim(ucwords($request->value));
        $size->product_id = trim($request->id);
        $size->price = trim($request->price);
        $size->save();

        $getsizeproduct = ProductSizeModel::getRecord($request->id);

        return response()->json([
            "status" => true,
            "items" => view("backend.product.parts._size", [
                "getsizeproduct" => $getsizeproduct,
            ])->render(),
        ], 200);
    }


    public function deletecolor($colorid, $product_id)
    {

        $color = ProductColorModel::get_signal($colorid);
        $color->is_delete = 1;
        $color->save();

        return redirect()->back();
    }


    public function deletesize($size_id, $product_id)
    {
        $size = ProductSizeModel::get_signal($size_id);
        $size->is_delete = 1;
        $size->save();
        return redirect()->back();
    }

    public function ImageUpload(Request $request)
    {

        if (!is_dir('upload/' . $request->id)) {
            mkdir('upload/' . $request->id, 0777, true);
        }

        $data = [];
        $data['initialPreview'] = [];
        $data['initialPreviewConfig'] = [];

        $files = $request->file('pictures');
        foreach ($files as $key => $value) {
            if (!empty($value)) {
                $token = csrf_token();
                $ext = 'jpg';

                $randomStr = Str::random(25);
                $randomStr_small = Str::random(25);
                $nameStr = Str::random(25);
                $filename = $randomStr . '.' . $ext;


                $filenamesmall = $randomStr_small . '.' . $ext;

                $name = $nameStr . '.' . $ext;

                $value->move('upload/' . $request->id . '/', $filename);


                $thumb_img = Image::read('upload/' . $request->id . '/' . $filename)
                    ->resize(600, 600);
                $thumb_img->save('upload/' . $request->id . '/' . $name, quality: 99);

                $thumb_small_img = Image::read('upload/' . $request->id . '/' . $filename)
                    ->resize(300, 300);
                $thumb_small_img->save('upload/' . $request->id . '/' . $filenamesmall, quality: 99);


                // $thumb_img = Image::read('upload/' . $request->id . '/' . $filename)->resize(600, 600);
                // $thumb_img->save('upload/' . $request->id . '/' . $name, 99);

                // $thumb_small_img = Image::read('upload/' . $request->id . '/' . $filename)->resize(300, 300);
                // $thumb_small_img->save('upload/' . $request->id . '/' . $filenamesmall, 99);

                $image = new ProductImageModel;
                $image->product_id = $request->id;
                $image->name = $name;
                $image->small = $filenamesmall;
                $image->orignal = $filename;
                $image->save();

                $data['initialPreview'][] = url('upload/' . $request->id . '/' . $filename);
                $data['initialPreviewConfig'][] = [
                    'caption' => 'upload/' . $request->id . '/',
                    $filename,
                    'size' => (int) File::size('upload/' . $request->id . '/', $filename),
                    'url' => url('admin/product/' . $image->id . '/delete-photo'),
                    'key' => $image->id,
                    'extra' => ['_token' => $token],
                ];
            }
        }

        return response()->json($data);

    }


    // delete service image
    public function delete_photo($id)
    {
        $image = ProductImageModel::find($id);
        if (!empty($image->name) && file_exists('upload/' . $image->product_id . '/' . $image->name)) {
            unlink('upload/' . $image->product_id . '/' . $image->name);
        }
        if (!empty($image->small) && file_exists('upload/' . $image->product_id . '/' . $image->small)) {
            unlink('upload/' . $image->product_id . '/' . $image->small);
        }
        if (!empty($image->orignal) && file_exists('upload/' . $image->product_id . '/' . $image->orignal)) {
            unlink('upload/' . $image->product_id . '/' . $image->orignal);
        }
        $image->delete();
        return response()->json([
            'status' => true,
            'message' => 'Success ! that was successfully done.',
        ]);
    }

    public function contact_us_list(Request $request)
    {
        $data['getRecord'] = ContactUsModel::getRecord();
        return view('backend.contact_us.list', $data);
    }

    public function contact_us_delete($id, Request $request)
    {
        $delete = ContactUsModel::find($id);
        $delete->delete();
        return redirect()->back()->with('error', "Delete Record Successfully");
    }

}
