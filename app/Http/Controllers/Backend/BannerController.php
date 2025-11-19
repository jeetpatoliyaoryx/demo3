<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\BannerModel;
use App\Models\InstagramModel;
use App\Models\MarqueeModel;
use App\Models\SurfaceModel;
use App\Models\SpacingModel;
use App\Models\WhyShopModel;
use App\Models\CustomerSayModel;
use App\Models\EmailSubscribeModel;
use App\Models\SocialModel;
use App\Models\AllTitleModel;
use App\Models\AssuranceModel;
use App\Models\CatalogueModel;
use App\Models\CategoryModel;
use App\Models\AboutImageModel;
use App\Models\SubscribeModel;
use App\Models\MarketingKeyModel;
use Str;
use File;

class BannerController extends Controller
{
    public function banner_list()
    {
        $data['getRecord'] = BannerModel::get();
        $data['meta_title'] = "Banner List";
        return view('backend.banner.list', $data);         
    }

    public function add_banner()
    {
        $data['meta_title'] = "Add Banner";
        $data['getCatalogue'] = CatalogueModel::get();
        $data['getParentCategory'] = CategoryModel::getParentCategory(0);
        return view('backend.banner.add', $data);         
    }

    public function add_banner_store(Request $request)
    {

        $category         = new BannerModel;
        $category->title   = trim($request->title);
        $category->sub_title = trim($request->sub_title);
        $category->button_link   = trim($request->button_link);
        $category->button_text = trim($request->button_text);
        $category->type_catalogue_category = trim($request->type_catalogue_category);
        $category->category_id = trim($request->category_id);
        $category->catalogue_id = trim($request->catalogue_id);
     
     
        if(!empty($request->file('banner_image'))){
            if(!empty($category->banner_image) && file_exists('upload/banner_image/'.$category->banner_image)){
                unlink('upload/banner_image/'.$category->banner_image);
            }

            $file = $request->file('banner_image');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/banner_image/',$filename);
            $category->banner_image = $filename;
        }

        $category->save();

        return redirect('admin/banner')->with('success', "Record Successfully Create");
    }

    public function edit_banner($id)
    {
        $getrecord = BannerModel::get_single($id);
        $data['getCatalogue'] = CatalogueModel::get();
        $data['getParentCategory'] = CategoryModel::getParentCategory(0);

        $data['getrecord'] = $getrecord;
         $data['meta_title'] = "Edit Banner";
        return view('backend.banner.edit',$data);   
    }

    public function edit_banner_update($id, Request $request)
    {   
        $category         = BannerModel::get_single($id);
        $category->title   = trim($request->title);
        $category->sub_title = trim($request->sub_title);
        $category->button_link   = trim($request->button_link);
        $category->button_text = trim($request->button_text);
        $category->type_catalogue_category = trim($request->type_catalogue_category);
        $category->category_id = trim($request->category_id);
        $category->catalogue_id = trim($request->catalogue_id);
     
        if(!empty($request->file('banner_image'))){
            if(!empty($category->banner_image) && file_exists('upload/banner_image/'.$category->banner_image)){
                unlink('upload/banner_image/'.$category->banner_image);
            }

            $file = $request->file('banner_image');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/banner_image/',$filename);
            $category->banner_image = $filename;
        }

        $category->save();

        return redirect('admin/banner')->with('success', "Record Successfully Update");
    }

    public function banner_delete($id)
    {
        $save = BannerModel::get_single($id)->delete();
        
        return redirect()->back()->with('success', 'Record successfully deleted');
    }




    public function instagram_list()
    {
        $data['getRecord'] = InstagramModel::get();
        $data['meta_title'] = "Instagram List";
        return view('backend.instagram.list', $data);         
    }

    public function add_instagram()
    {
        $data['meta_title'] = "Add Instagram";
        return view('backend.instagram.add', $data);         
    }

    public function add_instagram_store(Request $request)
    {
        $category         = new InstagramModel;
        $category->instagram_link   = trim($request->instagram_link);

     
     
        if(!empty($request->file('instagram_image'))){
            if(!empty($category->instagram_image) && file_exists('upload/instagram_image/'.$category->instagram_image)){
                unlink('upload/instagram_image/'.$category->instagram_image);
            }

            $file = $request->file('instagram_image');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/instagram_image/',$filename);
            $category->instagram_image = $filename;
        }

        $category->save();

        return redirect('admin/instagram')->with('success', "Record Successfully Create");
    }

    public function edit_instagram($id)
    {
        $getrecord = InstagramModel::get_single($id);
        $data['getrecord'] = $getrecord;
               $data['meta_title'] = "Edit Instagram";
        return view('backend.instagram.edit',$data);   
    }

    public function edit_instagram_update($id, Request $request)
    {   
        $category         = InstagramModel::get_single($id);
        $category->instagram_link   = trim($request->instagram_link);

        if(!empty($request->file('instagram_image'))){
            if(!empty($category->instagram_image) && file_exists('upload/instagram_image/'.$category->instagram_image)){
                unlink('upload/instagram_image/'.$category->instagram_image);
            }

            $file = $request->file('instagram_image');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/instagram_image/',$filename);
            $category->instagram_image = $filename;
        }
        $category->save();

        return redirect('admin/instagram')->with('success', "Record Successfully Update");
    }

    public function instagram_delete($id)
    {
        $save = InstagramModel::get_single($id)->delete();
        
        return redirect()->back()->with('success', 'Record successfully deleted');
    }


// marquee start

    public function marquee_list()
    {
        $data['getRecord'] = MarqueeModel::get();
        $data['meta_title'] = "Marquee List";
        return view('backend.marquee.list', $data);         
    }

    public function add_marquee()
    {
        $data['meta_title'] = "Add Marquee";
        return view('backend.marquee.add', $data);         
    }

    public function add_marquee_store(Request $request)
    {
        $category         = new MarqueeModel;
        $category->title   = trim($request->title);
        $category->save();

        return redirect('admin/marquee')->with('success', "Record Successfully Create");
    }

    public function edit_marquee($id)
    {
        $getrecord = MarqueeModel::get_single($id);
        $data['getrecord'] = $getrecord;
        return view('backend.marquee.edit',$data);   
    }

    public function edit_marquee_update($id, Request $request)
    {   
        $category         = MarqueeModel::get_single($id);
        $category->title   = trim($request->title);
        $category->save();

        return redirect('admin/marquee')->with('success', "Record Successfully Update");
    }

    public function marquee_delete($id)
    {
        $save = MarqueeModel::get_single($id)->delete();
        
        return redirect()->back()->with('success', 'Record successfully deleted');
    }

    // surface

    public function surface(Request $request)
    {

        $data['getRecord'] = SurfaceModel::first();
        $data['getCatalogue'] = CatalogueModel::get();
        $data['getParentCategory'] = CategoryModel::getParentCategory(0);
        $data['meta_title'] = "Surface";
        return view('backend.surface.update', $data);

    }

    public function update_surface(Request $request)
    {
        $user = SurfaceModel::first();
        $user->title     = trim($request->title);
        $user->sub_title     = trim($request->sub_title);
        $user->button_link     = trim($request->button_link);
        $user->button_text     = trim($request->button_text);
        $user->type_catalogue_category = trim($request->type_catalogue_category);
        $user->category_id = trim($request->category_id);
        $user->catalogue_id = trim($request->catalogue_id);

        if(!empty($request->file('image'))){
            if(!empty($user->image) && file_exists('upload/surface/'.$user->image)){
                unlink('upload/surface/'.$user->image);
            }

            $file = $request->file('image');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/surface/',$filename);
            $user->image = $filename;
        }

        $user->save();
        return redirect('admin/surface')->with('success', 'Record successfully update!!!');
    }


    //

    public function spacing(Request $request)
    {

        $data['getRecord'] = SpacingModel::first();
        $data['getCatalogue'] = CatalogueModel::get();
        $data['getParentCategory'] = CategoryModel::getParentCategory(0);
        $data['meta_title'] = "Spacing";
        return view('backend.spacing.update', $data);

    }

    public function update_spacing(Request $request)
    {
        $user = SpacingModel::first();
        $user->title     = trim($request->title);
        $user->sub_title     = trim($request->sub_title);
        $user->title_1     = trim($request->title_1);
        $user->sub_title_1     = trim($request->sub_title_1);
        $user->description     = trim($request->description);
        $user->image_title     = trim($request->image_title);
        $user->image_title_2     = trim($request->image_title_2);
     
        if(!empty($request->file('image'))){
            if(!empty($user->image) && file_exists('upload/spacing/'.$user->image)){
                unlink('upload/spacing/'.$user->image);
            }

            $file = $request->file('image');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/spacing/',$filename);
            $user->image = $filename;
        }

          if(!empty($request->file('image_1'))){
            if(!empty($user->image_1) && file_exists('upload/spacing/'.$user->image_1)){
                unlink('upload/spacing/'.$user->image_1);
            }

            $file = $request->file('image_1');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/spacing/',$filename);
            $user->image_1 = $filename;
        }


          if(!empty($request->file('image_2'))){
            if(!empty($user->image_2) && file_exists('upload/spacing/'.$user->image_2)){
                unlink('upload/spacing/'.$user->image_2);
            }

            $file = $request->file('image_2');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/spacing/',$filename);
            $user->image_2 = $filename;
        }

        $user->type_catalogue_category_1 = trim($request->type_catalogue_category_1);
        $user->category_id_1 = trim($request->category_id_1);
        $user->catalogue_id_1 = trim($request->catalogue_id_1);
        $user->type_catalogue_category_2 = trim($request->type_catalogue_category_2);
        $user->category_id_2 = trim($request->category_id_2);
        $user->catalogue_id_2 = trim($request->catalogue_id_2);
        $user->type_catalogue_category_3 = trim($request->type_catalogue_category_3);
        $user->category_id_3 = trim($request->category_id_3);
        $user->catalogue_id_3 = trim($request->catalogue_id_3);
        $user->save();
        return redirect('admin/spacing')->with('success', 'Record successfully update!!!');
    }

  
    public function why_shop()
    {
        $data['getRecord'] = WhyShopModel::get();
        $data['meta_title'] = "Why Shop List";
        return view('backend.why_shop.list', $data);         
    }

    public function add_why_shop()
    {
        $data['meta_title'] = "Add Why Shop";
        return view('backend.why_shop.add', $data);         
    }

    public function add_why_shop_store(Request $request)
    {
        $category         = new WhyShopModel;
        $category->title   = trim($request->title);
        $category->sub_title   = trim($request->sub_title);
        if(!empty($request->file('image'))){
            if(!empty($category->image) && file_exists('upload/why_shop/'.$category->image)){
                unlink('upload/why_shop/'.$category->image);
            }

            $file = $request->file('image');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/why_shop/',$filename);
            $category->image = $filename;
        }

        $category->save();

        return redirect('admin/why_shop')->with('success', "Record Successfully Create");
    }

    public function edit_why_shop($id)
    {
        $data['getrecord'] = WhyShopModel::get_single($id);
        return view('backend.why_shop.edit',$data);   
    }

    public function edit_why_shop_update($id, Request $request)
    {   
        $category              = WhyShopModel::get_single($id);
        $category->title       = trim($request->title);
        $category->sub_title   = trim($request->sub_title);
        if(!empty($request->file('image'))){
            if(!empty($category->image) && file_exists('upload/why_shop/'.$category->image)){
                unlink('upload/why_shop/'.$category->image);
            }

            $file = $request->file('image');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/why_shop/',$filename);
            $category->image = $filename;
        }

        $category->save();

        return redirect('admin/why_shop')->with('success', "Record Successfully Update");
    }

    public function why_shop_delete($id)
    {
        $save = WhyShopModel::get_single($id)->delete();
        return redirect()->back()->with('success', 'Record successfully deleted');
    }

//customer say
    public function customer_say()
    {
        $data['getRecord'] = CustomerSayModel::get();
        $data['meta_title'] = "Customer Say List";
        return view('backend.customer_say.list', $data);         
    }

    public function add_customer_say()
    {
        $data['meta_title'] = "Add Customer Say";
        return view('backend.customer_say.add', $data);         
    }

    public function add_customer_say_store(Request $request)
    {
        $category         = new CustomerSayModel;
        $category->rating   = trim($request->rating);
        $category->description = trim($request->description);
        $category->name   = trim($request->name);
        $category->title = trim($request->title);
         $category->price = trim($request->price);
     
        if(!empty($request->file('image'))){
            if(!empty($category->image) && file_exists('upload/customer_say/'.$category->image)){
                unlink('upload/customer_say/'.$category->image);
            }

            $file = $request->file('image');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/customer_say/',$filename);
            $category->image = $filename;
        }

        $category->save();

        return redirect('admin/customer_say')->with('success', "Record Successfully Create");
    }

    public function edit_customer_say($id)
    {
        $getrecord = CustomerSayModel::get_single($id);
        $data['getrecord'] = $getrecord;
        $data['meta_title'] = "Edit Customer Say";
        return view('backend.customer_say.edit',$data);   
    }

    public function edit_customer_say_update($id, Request $request)
    {   
        $category         = CustomerSayModel::get_single($id);
        $category->rating   = trim($request->rating);
        $category->description = trim($request->description);
        $category->name   = trim($request->name);
        $category->title = trim($request->title);
         $category->price = trim($request->price);
     
        if(!empty($request->file('image'))){
            if(!empty($category->image) && file_exists('upload/customer_say/'.$category->image)){
                unlink('upload/customer_say/'.$category->image);
            }

            $file = $request->file('image');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/customer_say/',$filename);
            $category->image = $filename;
        }

        $category->save();

        return redirect('admin/customer_say')->with('success', "Record Successfully Update");
    }

    public function customer_say_delete($id)
    {
        $save = CustomerSayModel::get_single($id)->delete();
        
        return redirect()->back()->with('success', 'Record successfully deleted');
    }

    public function email_subscribe()
    {
        $data['getRecord'] = EmailSubscribeModel::get();
        $data['meta_title'] = "Email Subscribe List";
        return view('backend.email_subscribe.list', $data);         
    }

    public function email_subscribe_delete($id)
    {
        $save = EmailSubscribeModel::find($id)->delete();
        
        return redirect()->back()->with('success', 'Record successfully deleted');
    }



// Social



    public function social_list()
    {
        $data['getRecord'] = SocialModel::get();
        $data['meta_title'] = "Social List";
        return view('backend.social.list', $data);         
    }

    public function add_social()
    {
        $data['meta_title'] = "Add Social";
        return view('backend.social.add', $data);         
    }

    public function add_social_store(Request $request)
    {
        $category         = new SocialModel;
        $category->name   = trim($request->name);
        $category->social_link   = trim($request->social_link);
        $category->save();

        return redirect('admin/social')->with('success', "Record Successfully Create");
    }

    public function edit_social($id)
    {
        $getrecord = SocialModel::get_single($id);
        $data['getrecord'] = $getrecord;
        return view('backend.social.edit',$data);   
    }

    public function edit_social_update($id, Request $request)
    {   
        $category         = SocialModel::get_single($id);
        $category->name   = trim($request->name);
        $category->social_link   = trim($request->social_link);
        $category->save();

        return redirect('admin/social')->with('success', "Record Successfully Update");
    }

    public function social_delete($id)
    {
        $save = SocialModel::get_single($id)->delete();
        
        return redirect()->back()->with('success', 'Record successfully deleted');
    }

    
  // All Title

    public function all_title(Request $request)
    {

        $data['getRecord'] = AllTitleModel::first();
        $data['meta_title'] = "All Title";
        return view('backend.all_title.update', $data);

    }

    public function all_title_udpate(Request $request)
    {
        $seo = AllTitleModel::first();
        $seo->categories_title = trim($request->categories_title);
        $seo->customer_1 = trim($request->customer_1);
        $seo->customer_2 = trim($request->customer_2);
        $seo->instagram_1 = trim($request->instagram_1);
        $seo->instagram_2 = trim($request->instagram_2);
        $seo->save();
        return redirect('admin/all_title')->with('success', 'Record successfully update!!!');
    }


//Assurance


    public function assurance_list()
    {
        $data['getRecord'] = AssuranceModel::get();
        $data['meta_title'] = "Assurance List";
        return view('backend.assurance.list', $data);         
    }

    public function add_assurance()
    {
        $data['meta_title'] = "Add Assurance";
        return view('backend.assurance.add', $data);         
    }

    public function add_assurance_store(Request $request)
    {
        $category         = new AssuranceModel;
        $category->title   = trim($request->title);
        $category->sub_title   = trim($request->sub_title);
        

        if(!empty($request->file('icon_name'))){
            if(!empty($category->icon_name) && file_exists('upload/icon_name/'.$category->icon_name)){
                unlink('upload/icon_name/'.$category->icon_name);
            }

            $file = $request->file('icon_name');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/icon_name/',$filename);
            $category->icon_name = $filename;
        }

        $category->save();

        return redirect('admin/assurance')->with('success', "Record Successfully Create");
    }

    public function edit_assurance($id)
    {
        $getrecord = AssuranceModel::get_single($id);
        $data['getrecord'] = $getrecord;
        $data['meta_title'] = "Edit Assurance";
        return view('backend.assurance.edit',$data);   
    }

    public function edit_assurance_update($id, Request $request)
    {   
        $category         = AssuranceModel::get_single($id);
        $category->title   = trim($request->title);
        $category->sub_title   = trim($request->sub_title);

        if(!empty($request->file('icon_name'))){
            if(!empty($category->icon_name) && file_exists('upload/icon_name/'.$category->icon_name)){
                unlink('upload/icon_name/'.$category->icon_name);
            }

            $file = $request->file('icon_name');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/icon_name/',$filename);
            $category->icon_name = $filename;
        }
        $category->save();

        return redirect('admin/assurance')->with('success', "Record Successfully Update");
    }

    public function assurance_delete($id)
    {
        $save = AssuranceModel::get_single($id)->delete();
        
        return redirect()->back()->with('success', 'Record successfully deleted');
    }




    public function about_image(Request $request)
    {

        $data['getRecord'] = AboutImageModel::first();
        $data['meta_title'] = "About Image";
        return view('backend.about_image.update', $data);

    }

    public function update_about_image(Request $request)
    {
        $user = AboutImageModel::first();
        $user->title     = trim($request->title);
        $user->facebook_title     = trim($request->facebook_title);
        $user->facebook_sub_title     = trim($request->facebook_sub_title);
        if(!empty($request->file('image'))){
            if(!empty($user->image) && file_exists('upload/about_image/'.$user->image)){
                unlink('upload/about_image/'.$user->image);
            }

            $file = $request->file('image');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/about_image/',$filename);
            $user->image = $filename;
        }

        $user->save();
        return redirect('admin/about_image')->with('success', 'Record successfully update!!!');
    }


 // Email subscribe

    public function subscribe_image(Request $request)
    {

        $data['getRecord'] = SubscribeModel::first();
        $data['meta_title'] = "Subscribe";
        return view('backend.subscribe.update', $data);

    }

    public function update_subscribe_image(Request $request)
    {
        $user = SubscribeModel::first();
        $user->title     = trim($request->title);
        $user->sub_title     = trim($request->sub_title);
        $user->button_text     = trim($request->button_text);
        if(!empty($request->file('image'))){
            if(!empty($user->image) && file_exists('upload/subscribe/'.$user->image)){
                unlink('upload/subscribe/'.$user->image);
            }

            $file = $request->file('image');
            $randomStr = Str::random(30);
            $filename  = $randomStr .'.'.$file->getClientOriginalExtension();
            $file->move('upload/subscribe/',$filename);
            $user->image = $filename;
        }

        $user->save();
        return redirect('admin/subscribe')->with('success', 'Record successfully update!!!');
    }

      public function marketing_key(Request $request)
    {

        $data['getRecord'] = MarketingKeyModel::first();
        $data['meta_title'] = "Marketing Key";
        return view('backend.marketing_key.update', $data);

    }

    public function update_marketing_key(Request $request)
    {
        $user = MarketingKeyModel::first();
        $user->facebook_pixel_id     = trim($request->facebook_pixel_id);
        $user->google_analytics_id     = trim($request->google_analytics_id);
        $user->save();
        return redirect('admin/marketing_key')->with('success', 'Record successfully update!!!');
    }




}