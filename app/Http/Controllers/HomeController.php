<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\BannerModel;
use App\Models\InstagramModel;
use App\Models\MarqueeModel;
use App\Models\SurfaceModel;
use App\Models\SpacingModel;
use App\Models\WhyShopModel;
use App\Models\CustomerSayModel;
use App\Models\CatalogueProductModel;
use App\Models\CatalogueModel;
use App\Models\SEOModel;
use App\Models\AllTitleModel;
use App\Models\SubscribeModel;
use App\Models\FooterModel;
use Mail;
use Auth;
use Hash;
use Str;


class HomeController extends Controller
{
	public function index(Request $request)
    {
        $seo = SEOModel::get_slug('home');
        $data['meta_title'] = $seo->meta_title;
        $data['meta_description'] = $seo->meta_description;
        $data['meta_canonical'] = '';

        $data['getRecordSeo'] = $seo;

        $data['getFrontProductsHomeNewArrival'] = ProductModel::getFrontProductsHomeNewArrival();
        $data['getFrontProductsHomeBestSelling'] = ProductModel::getFrontProductsHomeBestSelling();
        $data['getFrontProductsHomeFeatured'] = ProductModel::getFrontProductsHomeFeatured();
        $data['getParentCategory'] = CategoryModel::getParentCategory(0);
        $data['getBanner'] = BannerModel::get();
        $data['getInstagram'] = InstagramModel::get();
        $data['getMarquee'] = MarqueeModel::get();
        $data['getSurface'] = SurfaceModel::first();
        $data['getSpacing'] = SpacingModel::first();
        $data['getWhyShop'] = WhyShopModel::orderBy('id', 'desc')->get();
        $data['getCustomerSay'] = CustomerSayModel::get();
        $data['getAllTitle'] = AllTitleModel::first();
        $data['getSubscribe'] = SubscribeModel::first();
        $data['SEgetHomeFooter'] = FooterModel::first();
        return view('index', $data);
    }


    public function catalogue_page($encoded)
    {
        $id = base64_decode($encoded);

        $data['getRecord'] = CatalogueModel::where('id', '=', $id)->first();
        $data['getFrontCatalogue'] = ProductModel::getFrontCatalogue($id);
        $data['meta_title'] = "Catalogue";
        return view('catalogue', $data);

    }
}