<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DiscountCodeModel;

class DiscountCodeController extends Controller
{

	public function index(Request $request){
		$getrecord = DiscountCodeModel::orderBy('id', 'desc');
       
        
        $getrecord = $getrecord->get();
        $data['getrecord'] = $getrecord;
          $data['meta_title'] = "Coupon Code";
		return view('backend.discount_code.list', $data);
	}

	public function addDiscountCode()
	{
		 $data['meta_title'] = "Add Coupon Code";	
		return view('backend.discount_code.add', $data);
	}

	public function addStoreDiscountCode(Request $request)
	{
		
    	$record = new DiscountCodeModel;
		$record->discount_code = trim(strtoupper($request->discount_code));
        $record->discount_price = !empty($request->discount_price) ? $request->discount_price : '0';
        $record->type  = trim($request->type);
        $record->maximum_price  = trim($request->maximum_price);
        $record->save();
		return redirect('admin/couponcode')->with('success', 'Record Successfully Create');
	}

	public function updateDiscountCode($id = '', Request $request)
	{
		
    	$record = DiscountCodeModel::find($id);
		$record->discount_code = trim(strtoupper($request->discount_code));
        $record->discount_price = !empty($request->discount_price) ? $request->discount_price : '0';
        $record->type  = trim($request->type);
        $record->maximum_price  = trim($request->maximum_price);
        $record->save();
		return redirect('admin/couponcode')->with('success', 'Record Successfully Update');
	}


	public function editDiscountCode($id)
	{
	
        $getrecord = DiscountCodeModel::find($id); 
    
        $data['getrecord'] = $getrecord;
         $data['meta_title'] = "Edit Coupon Code";	
        return view('backend.discount_code.edit', $data);
	}

	public function destroyDiscountCode($id)
    {
      
        $getrecord = DiscountCodeModel::find($id); 
        $getrecord->delete();
        return redirect('admin/couponcode')->with('success', 'Record successfully deleted!');
    }
}