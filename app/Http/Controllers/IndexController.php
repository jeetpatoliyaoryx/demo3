<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\ContactUsModel;
use App\Models\ContactSettingModel;
use App\Models\EmailSubscribeModel;
use App\Models\AssuranceModel;
use App\Models\TermsConditionsModel;
use App\Models\PrivacyPolicyModel;
use App\Models\ReturnRefundModel;
use App\Models\ShippingPolicyModel;
use App\Models\AboutImageModel;
use App\Models\WhyShopModel;
use App\Models\CustomerSayModel;
use App\Models\AllTitleModel;
use App\Models\AboutAddModel;
use App\Models\FacebookModel;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function search(Request $request)
    {
        $products = ProductModel::with(['getsize', 'getcolor'])
            ->when($request->title, fn($q) => 
                $q->where('title', 'LIKE', '%' . $request->title . '%')
            )
            ->where('product.is_public', '=', 0)
            ->where('product.is_delete', '=', 0)
            ->get();

        return view('parts._product_search', [
            'getFrontProductsApp' => $products
        ]);
    }


    public function getCategory($cat1 = '', $cat2 = '', $cat3 = '', Request $request)
    {
        if (empty($cat1)) {
            abort(404);
        }

        $data = [];
        $categoryslug = '';
        $category = [];

        // Detect active level
        if (!empty($cat3)) {
            $data['active'] = 3;
            $data['backurl'] = url('c/' . $cat1 . '/' . $cat2);
            $categoryslug = $cat3;
            $category = CategoryModel::getCategoryID($cat3);
            $SlugCategory = CategoryModel::getSlug($cat3);
            $data['getCategoryFilter'] = CategoryModel::getCategoryLastFilter($cat1, $cat2, $cat3);
        } elseif (!empty($cat2)) {
            $data['active'] = 2;
            $data['backurl'] = url('c/' . $cat1);
            $categoryslug = $cat2;
            $category = CategoryModel::getCategoryID($cat2);
            $SlugCategory = CategoryModel::getSlug($cat2);
            $data['getCategoryFilter'] = CategoryModel::getCategorySecondFilter($cat1, $cat2);
        } else {
            $data['active'] = 1;
            $data['backurl'] = url('c/' . $cat1);
            $categoryslug = $cat1;
            $category = CategoryModel::getCategoryID($cat1);
            $SlugCategory = CategoryModel::getSlug($cat1);
            $data['getCategoryFilter'] = CategoryModel::getCategoryFirstFilter($cat1);
        }

        // Meta tags
        $data['meta_title'] = 'Buy ' . $SlugCategory->name . ' | Latest Designer ' . $SlugCategory->name . ' Shopping';
        $data['meta_description'] = 'Buy ' . $SlugCategory->name . ' online. Buy Designer Saree, Dresses & Kurtis, Suits & Dress Material, Top Wear, and Lehengas at Desirt. Online shopping for women ' . $SlugCategory->name . ' from our vast range in low prices.';

        // Category header
        $getCategoryArrayHead = array_filter([$cat1, $cat2, $cat3]);
        $data['getCategoryHeader'] = CategoryModel::getSlugCategory($getCategoryArrayHead);

        // Product list
        $data['getFrontProduct'] = ProductModel::getFrontProduct($request, $category);

        // Selected category
        $data['getCategory'] = CategoryModel::getSlug($categoryslug);
        $data['categoryslug'] = $categoryslug;

        // Preload product counts for all filter categories
        $data['productCounts'] = ProductModel::getProductCounts();

        return view('product', $data);
    }

    public function getCategory_old($cat1 = '',$cat2 = '', $cat3 = '', Request $request)
    {
        if(!empty($cat1))
        {
            $categoryslug = '';
            $category = array();
            if(!empty($cat3))
            {


                $data['active'] = 3;
                $data['backurl'] = url('c/'.$cat1.'/'.$cat2);
                $categoryslug = $cat3;
                $category = CategoryModel::getCategoryID($cat3);

                $SlugCategory = CategoryModel::getSlug($cat3);
                $data['meta_title'] = 'Buy '.$SlugCategory->name.' | Latest Designer '.$SlugCategory->name.' Shopping';
                $data['meta_description'] = 'Buy '.$SlugCategory->name.' online. Buy Designer Saree, Dresses & Kurtis, Suits & Dress Material, Top Wear, and Lehengas at Desirt. Online shopping for women '.$SlugCategory->name.' from our vast range in low prices.';
                $data['getCategoryFilter'] = CategoryModel::getCategoryLastFilter($cat1, $cat2, $cat3);
            }
            elseif(!empty($cat2))
            {

                $data['active'] = 2;
                $data['backurl'] = url('c/'.$cat1);
                $categoryslug = $cat2;
                $category = CategoryModel::getCategoryID($cat2);

                $SlugCategory = CategoryModel::getSlug($cat2);
                $data['meta_title'] = 'Buy '.$SlugCategory->name.' | Latest Designer '.$SlugCategory->name.' Shopping';
                $data['meta_description'] = 'Buy '.$SlugCategory->name.' online. Buy Designer Saree, Dresses & Kurtis, Suits & Dress Material, Top Wear, and Lehengas at Desirt. Online shopping for women '.$SlugCategory->name.' from our vast range in low prices.';
                $data['getCategoryFilter'] = CategoryModel::getCategorySecondFilter($cat1, $cat2);
            }
            elseif(!empty($cat1))
            {
               
                $data['active'] = 1;
                $data['backurl'] = url('c/'.$cat1);
                $categoryslug = $cat1;
                $category = CategoryModel::getCategoryID($cat1);

                $SlugCategory = CategoryModel::getSlug($cat1);
                $data['meta_title'] = 'Buy '.$SlugCategory->name.' | Latest Designer '.$SlugCategory->name.' Shopping';
                $data['meta_description'] = 'Buy '.$SlugCategory->name.' online. Buy Designer Saree, Dresses & Kurtis, Suits & Dress Material, Top Wear, and Lehengas at Desirt. Online shopping for women '.$SlugCategory->name.' from our vast range in low prices.';
                $data['getCategoryFilter'] = CategoryModel::getCategoryFirstFilter($cat1);
            }
            
            $getCategoryArrayHead = array($cat1, $cat2, $cat3);
            $data['getCategoryHeader'] = CategoryModel::getSlugCategory($getCategoryArrayHead);

            $data['getFrontProduct'] = ProductModel::getFrontProduct($request, $category);

            $data['getCategory'] = CategoryModel::getSlug($categoryslug);
            $data['categoryslug'] = $categoryslug;
            return view('product', $data);    
        }
        else
        {
            abort(404);
        }    
    }

    public function getACategory($cat1 = '',$cat2 = '', Request $request)
    {

        if(!empty($cat1))
        {
            $categoryslug = '';
            $category = array();
            if(!empty($cat2))
            {
                $data['active'] = 2;
                $data['backurl'] = url('m/'.$cat1);
                $categoryslug = $cat2;
                $category = CategoryModel::getCategoryID($cat2);

                $SlugCategory = CategoryModel::getSlug($cat2);
                $data['meta_title'] = 'Buy '.$SlugCategory->name.' | Latest Designer '.$SlugCategory->name.' Shopping';
                $data['meta_description'] = 'Buy '.$SlugCategory->name.' online. Buy Designer Saree, Dresses & Kurtis, Suits & Dress Material, Top Wear, and Lehengas at Desirt. Online shopping for women '.$SlugCategory->name.' from our vast range in low prices.';
                $data['getCategoryFilter'] = CategoryModel::getCategorySecondFilter($cat1, $cat2);
            }
            elseif(!empty($cat1))
            {
                $data['active'] = 1;
                $data['backurl'] = url('m/'.$cat1);
                $categoryslug = $cat1;
                $category = CategoryModel::getCategoryID($cat1);

                $SlugCategory = CategoryModel::getSlug($cat1);
                $data['meta_title'] = 'Buy '.$SlugCategory->name.' | Latest Designer '.$SlugCategory->name.' Shopping';
                $data['meta_description'] = 'Buy '.$SlugCategory->name.' online. Buy Designer Saree, Dresses & Kurtis, Suits & Dress Material, Top Wear, and Lehengas at Desirt. Online shopping for women '.$SlugCategory->name.' from our vast range in low prices.';
                $data['getCategoryFilter'] = CategoryModel::getCategoryFirstFilter($cat1);
            }
            
            $getCategoryArrayHead = array($cat1, $cat2);
            $data['getCategoryHeader'] = CategoryModel::getSlugCategory($getCategoryArrayHead);

            $data['getFrontProduct'] = ProductModel::getFrontProduct($request, $category);

            $data['getCategory'] = CategoryModel::getSlug($categoryslug);
            $data['categoryslug'] = $categoryslug;
            return view('product', $data);    
        }
        else
        {
            abort(404);
        }    
    }

    public function getMCategory($cat1 = '', Request $request)
    {
        if(!empty($cat1))
        {
            $categoryslug = '';
            $category = array();
            
            if(!empty($cat1))
            {
                $data['active'] = 1;
                $data['backurl'] = url('m/'.$cat1);
                $categoryslug = $cat1;
                $category = CategoryModel::getCategoryID($cat1);

                $SlugCategory = CategoryModel::getSlug($cat1);
                $data['meta_title'] = 'Buy '.$SlugCategory->name.' | Latest Designer '.$SlugCategory->name.' Shopping';
                $data['meta_description'] = 'Buy '.$SlugCategory->name.' online. Buy Designer Saree, Dresses & Kurtis, Suits & Dress Material, Top Wear, and Lehengas at Desirt. Online shopping for women '.$SlugCategory->name.' from our vast range in low prices.';
                $data['getCategoryFilter'] = CategoryModel::getCategoryFirstFilter($cat1);
            }
            
            $getCategoryArrayHead = array($cat1);
            $data['getCategoryHeader'] = CategoryModel::getSlugCategory($getCategoryArrayHead);

            $data['getFrontProduct'] = ProductModel::getFrontProduct($request, $category);

            $data['getCategory'] = CategoryModel::getSlug($categoryslug);
            $data['categoryslug'] = $categoryslug;
            return view('product', $data);    
        }
        else
        {
            abort(404);
        }  
    }

    public function item($slug, Request $request)
    {
        
        $product = ProductModel::getSlug($slug);
        if(!empty($product))
        {
            $data['getCategory'] = CategoryModel::getCategoryParent($product->category_id);
            $data['product'] = $product;

            $data['meta_title']       = $product->title;
            $data['meta_canonical']   = url($product->slug);
            $data['getAssurance'] = AssuranceModel::get();
            return view('item', $data);    
        }
        else        
        {
            abort(404);
        }
    }


    public function contact()
    {
        // $seo = SEOModel::get_slug('contact');
        // $data['meta_title'] = $seo->meta_title;
        // $data['meta_description'] = $seo->meta_description;
        // $data['meta_canonical'] = url('contact');
        $data['meta_title'] = "Contact";
         $data['getRecord'] = ContactSettingModel::first();
        return view('page.contact', $data);
    }

    public function submit_contact(Request $request)
    {
        $save = new ContactUsModel;
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        $save->message = trim($request->message);
        $save->save();
        // Mail::to('abc@gmail.com')->send(new ContactMail($request));
        return redirect()->back()->with('success', "Your message successfully sent.");
    }

    public function privacy()
    {
        // $seo = SEOModel::get_slug('privacy');
        // $data['meta_title'] = $seo->meta_title;
        // $data['meta_description'] = $seo->meta_description;
        // $data['meta_canonical'] = url('privacy');
        $data['getRecord'] = PrivacyPolicyModel::get();
        $data['meta_title'] = "Privacy";
        return view('page.privacy', $data);
    }

    public function terms()
    {
        // $seo = SEOModel::get_slug('terms');
        // $data['meta_title'] = $seo->meta_title;
        // $data['meta_description'] = $seo->meta_description;
        // $data['meta_canonical'] = url('terms');
        $data['getRecord'] = TermsConditionsModel::get();
        $data['meta_title'] = "Terms & Conditions";
        return view('page.terms', $data);
    }

    public function shipping_refund()
    {
        $data['getRecord'] = ShippingPolicyModel::get();
        $data['meta_title'] = "Shipping Refund";
        return view('page.shipping_refund', $data);
    }

    public function return_policy()
    {

        $data['getRecord'] = ReturnRefundModel::get();
        $data['meta_title'] = "Return Policy";
        return view('page.return_policy', $data);
    }

    public function about()
    {
        // $seo = SEOModel::get_slug('about');
        // $data['meta_title'] = $seo->meta_title;
        // $data['meta_description'] = $seo->meta_description;
        // $data['meta_canonical'] = url('about');
        $data['getRecord'] = AboutImageModel::first();
        $data['getWhyShop'] = WhyShopModel::orderBy('id', 'desc')->get();
        $data['getCustomerSay'] = CustomerSayModel::get();
        $data['getAllTitle'] = AllTitleModel::first();
        $data['getAbout'] = AboutAddModel::get();
        $data['getFacebook'] = FacebookModel::get();
        $data['meta_title'] = "About";
        return view('page.about', $data);
    }

       public function email_subscribe(Request $request)
    {
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL))
        {
            $json['status'] = false;
            $json['message'] = "Email address not currect.";
        }
        else
        {
            $count = EmailSubscribeModel::where('email', '=', $request->email)->count();
            if(empty($count))
            {
                $user = request()->validate([
                    'email'             => 'required|unique:email_subscribe,email',
                ]);

   
                $user        = new EmailSubscribeModel;
               
                $user->email = trim($request->email);

                $user->save();

                $json['status'] = true;
                $json['message'] = "Email Successfully Subscribed.";
            }
            else
            {
                $json['status'] = false;
                $json['message'] = "Your email address already exist.";
            }         
        }

        echo json_encode($json);
        
    }

}
