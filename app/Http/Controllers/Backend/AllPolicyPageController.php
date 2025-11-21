<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CancellationPolicyModel;
use Illuminate\Http\Request;
use Auth;
use App\Models\TermsConditionsModel;
use App\Models\PrivacyPolicyModel;
use App\Models\ReturnRefundModel;
use App\Models\ShippingPolicyModel;
use App\Models\AboutAddModel;
use App\Models\FacebookModel;
use Str;
use File;

class AllPolicyPageController extends Controller
{
    public function terms_conditions()
    {
        $data['getRecord'] = TermsConditionsModel::get();
        $data['meta_title'] = "Terms Conditions List";
        return view('backend.all_policy_page.terms_conditions_list', $data);
    }

    public function terms_conditions_add()
    {
        $data['meta_title'] = "Add Terms Conditions";
        return view('backend.all_policy_page.terms_conditions_add', $data);
    }

    public function terms_conditions_store(Request $request)
    {
        $category = new TermsConditionsModel;
        $category->title = trim($request->title);
        $category->description = trim($request->description);
        $category->save();

        return redirect('admin/terms_conditions')->with('success', "Record Successfully Create");
    }

    public function terms_conditions_edit($id)
    {

        $data['getrecord'] = TermsConditionsModel::get_single($id);
        $data['meta_title'] = "Edit Terms Conditions";
        return view('backend.all_policy_page.terms_conditions_edit', $data);
    }

    public function terms_conditions_update($id, Request $request)
    {
        $category = TermsConditionsModel::get_single($id);
        $category->title = trim($request->title);
        $category->description = trim($request->description);
        $category->save();

        return redirect('admin/terms_conditions')->with('success', "Record Successfully Update");
    }

    public function terms_conditions_delete($id)
    {
        $save = TermsConditionsModel::get_single($id)->delete();
        return redirect()->back()->with('success', 'Record successfully deleted');
    }

    // privacy_policy


    public function privacy_policy()
    {
        $data['getRecord'] = PrivacyPolicyModel::get();
        $data['meta_title'] = "Privacy Policy List";
        return view('backend.all_policy_page.privacy_policy_list', $data);
    }

    public function privacy_policy_add()
    {
        $data['meta_title'] = "Add Privacy Policy";
        return view('backend.all_policy_page.privacy_policy_add', $data);
    }

    public function privacy_policy_store(Request $request)
    {
        $category = new PrivacyPolicyModel;
        $category->title = trim($request->title);
        $category->description = trim($request->description);
        $category->save();

        return redirect('admin/privacy_policy')->with('success', "Record Successfully Create");
    }

    public function privacy_policy_edit($id)
    {

        $data['getrecord'] = PrivacyPolicyModel::get_single($id);
        $data['meta_title'] = "Edit Privacy Policy";
        return view('backend.all_policy_page.privacy_policy_edit', $data);
    }

    public function privacy_policy_update($id, Request $request)
    {
        $category = PrivacyPolicyModel::get_single($id);
        $category->title = trim($request->title);
        $category->description = trim($request->description);
        $category->save();

        return redirect('admin/privacy_policy')->with('success', "Record Successfully Update");
    }

    public function privacy_policy_delete($id)
    {
        $save = PrivacyPolicyModel::get_single($id)->delete();
        return redirect()->back()->with('success', 'Record successfully deleted');
    }
    //ReturnRefundModel


    public function return_refund()
    {
        $data['getRecord'] = ReturnRefundModel::get();
        $data['meta_title'] = "Return Refund List";
        return view('backend.all_policy_page.return_refund_list', $data);
    }

    public function return_refund_add()
    {
        $data['meta_title'] = "Add Return Refund";
        return view('backend.all_policy_page.return_refund_add', $data);
    }

    public function return_refund_store(Request $request)
    {
        $category = new ReturnRefundModel;
        $category->title = trim($request->title);
        $category->description = trim($request->description);
        $category->save();

        return redirect('admin/return_refund')->with('success', "Record Successfully Create");
    }

    public function return_refund_edit($id)
    {

        $data['getrecord'] = ReturnRefundModel::get_single($id);
        $data['meta_title'] = "Edit Return Refund";
        return view('backend.all_policy_page.return_refund_edit', $data);
    }

    public function return_refund_update($id, Request $request)
    {
        $category = ReturnRefundModel::get_single($id);
        $category->title = trim($request->title);
        $category->description = trim($request->description);
        $category->save();

        return redirect('admin/return_refund')->with('success', "Record Successfully Update");
    }

    public function return_refund_delete($id)
    {
        $save = ReturnRefundModel::get_single($id)->delete();
        return redirect()->back()->with('success', 'Record successfully deleted');
    }

    //ShippingPolicyModel


    public function shipping_policy()
    {
        $data['getRecord'] = ShippingPolicyModel::get();
        $data['meta_title'] = "Shipping Policy List";
        return view('backend.all_policy_page.shipping_policy_list', $data);
    }

    public function shipping_policy_add()
    {
        $data['meta_title'] = "Add Shipping Policy";
        return view('backend.all_policy_page.shipping_policy_add', $data);
    }

    public function shipping_policy_store(Request $request)
    {
        $category = new ShippingPolicyModel;
        $category->title = trim($request->title);
        $category->description = trim($request->description);
        $category->save();

        return redirect('admin/shipping_policy')->with('success', "Record Successfully Create");
    }

    public function shipping_policy_edit($id)
    {

        $data['getrecord'] = ShippingPolicyModel::get_single($id);
        $data['meta_title'] = "Edit Shipping Policy";
        return view('backend.all_policy_page.shipping_policy_edit', $data);
    }

    public function shipping_policy_update($id, Request $request)
    {
        $category = ShippingPolicyModel::get_single($id);
        $category->title = trim($request->title);
        $category->description = trim($request->description);
        $category->save();

        return redirect('admin/shipping_policy')->with('success', "Record Successfully Update");
    }

    public function shipping_policy_delete($id)
    {
        $save = ShippingPolicyModel::get_single($id)->delete();
        return redirect()->back()->with('success', 'Record successfully deleted');
    }


    // About add

    public function about_add()
    {
        $data['getRecord'] = AboutAddModel::get();
        $data['meta_title'] = "About List";
        return view('backend.about_add.list', $data);
    }

    public function about_add_add()
    {
        $data['meta_title'] = "Add About";
        return view('backend.about_add.add', $data);
    }

    public function about_add_store(Request $request)
    {
        $category = new AboutAddModel;
        $category->title = trim($request->title);
        $category->description = trim($request->description);
        $category->save();

        return redirect('admin/about_add')->with('success', "Record Successfully Create");
    }

    public function about_add_edit($id)
    {

        $data['getrecord'] = AboutAddModel::get_single($id);
        $data['meta_title'] = "Edit About Add";
        return view('backend.about_add.edit', $data);
    }

    public function about_add_update($id, Request $request)
    {
        $category = AboutAddModel::get_single($id);
        $category->title = trim($request->title);
        $category->description = trim($request->description);
        $category->save();

        return redirect('admin/about_add')->with('success', "Record Successfully Update");
    }

    public function about_add_delete($id)
    {
        $save = AboutAddModel::get_single($id)->delete();
        return redirect()->back()->with('success', 'Record successfully deleted');
    }

    //facebooklist

    public function facebooklist()
    {
        $data['getRecord'] = FacebookModel::get();
        $data['meta_title'] = "Facebook List";
        return view('backend.facebook.list', $data);
    }

    public function facebook_add()
    {
        $data['meta_title'] = "Add Facebook";
        return view('backend.facebook.add', $data);
    }

    public function facebook_store(Request $request)
    {
        $category = new FacebookModel;
        $category->name = trim($request->name);
        $category->position = trim($request->position);
        $category->facebook_link = trim($request->facebook_link);


        if (!empty($request->file('image'))) {
            if (!empty($category->image) && file_exists('upload/facebook/' . $category->image)) {
                unlink('upload/facebook/' . $category->image);
            }

            $file = $request->file('image');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('upload/facebook/', $filename);
            $category->image = $filename;
        }


        $category->save();

        return redirect('admin/facebook')->with('success', "Record Successfully Create");
    }

    public function facebook_edit($id)
    {

        $data['getrecord'] = FacebookModel::get_single($id);
        $data['meta_title'] = "Edit Facebook";
        return view('backend.facebook.edit', $data);
    }

    public function facebook_update($id, Request $request)
    {
        $category = FacebookModel::get_single($id);
        $category->name = trim($request->name);
        $category->position = trim($request->position);
        $category->facebook_link = trim($request->facebook_link);
        if (!empty($request->file('image'))) {
            if (!empty($category->image) && file_exists('upload/facebook/' . $category->image)) {
                unlink('upload/facebook/' . $category->image);
            }

            $file = $request->file('image');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('upload/facebook/', $filename);
            $category->image = $filename;
        }

        $category->save();

        return redirect('admin/facebook')->with('success', "Record Successfully Update");
    }

    public function facebook_delete($id)
    {
        $save = FacebookModel::get_single($id)->delete();
        return redirect()->back()->with('success', 'Record successfully deleted');
    }

    // cancellation_policy


    public function cancellation_policy()
    {
        $data['getRecord'] = CancellationPolicyModel::get();
        $data['meta_title'] = "Cancellation Policy List";
        return view('backend.all_policy_page.cancellation_policy_list', $data);
    }

    public function cancellation_policy_add()
    {
        $data['meta_title'] = "Add Cancellation Policy";
        return view('backend.all_policy_page.cancellation_policy_add', $data);
    }

    public function cancellation_policy_store(Request $request)
    {
        $category = new CancellationPolicyModel();
        $category->title = trim($request->title);
        $category->description = trim($request->description);
        $category->save();

        return redirect('admin/cancellation_policy')->with('success', "Record Successfully Create");
    }

    public function cancellation_policy_edit($id)
    {

        $data['getrecord'] = CancellationPolicyModel::get_single($id);
        $data['meta_title'] = "Edit Cancellation Policy";
        return view('backend.all_policy_page.cancellation_policy_edit', $data);
    }

    public function cancellation_policy_update($id, Request $request)
    {
        $category = CancellationPolicyModel::get_single($id);
        $category->title = trim($request->title);
        $category->description = trim($request->description);
        $category->save();

        return redirect('admin/cancellation_policy')->with('success', "Record Successfully Update");
    }

    public function cancellation_policy_delete($id)
    {
        $save = CancellationPolicyModel::get_single($id)->delete();
        return redirect()->back()->with('success', 'Record successfully deleted');
    }
}