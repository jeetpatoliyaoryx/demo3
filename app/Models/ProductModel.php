<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
use Request;
use DB;


class ProductModel extends Model
{
    use HasFactory;

    protected $table = "product";

    static public function get_single($id)
    {
        return self::find($id);
    }

    static public function getSlug($slug)
    {
        return self::where('slug','=',$slug)->first();
    }


    static public function getFrontCatalogue($id)
    {
        if (Session::has('rand.key')) {
            $seed = Session::get('rand.key');
        } else {
            $seed = rand(9999, 999999);
            Session::put('rand.key', $seed);
        }

        $return = self::query()
            ->join('catalogue_product', 'catalogue_product.product_id', '=', 'product.id')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->select('product.*')
            ->where('product.is_public', 0)
            ->where('product.is_delete', 0)
            ->where('catalogue_product.catalogue_id', $id)
            ->distinct() //  safer than groupBy for MySQL strict mode
            ->orderByRaw('RAND(?)', [$seed]) //  safe seeded random
            ->get();

        return $return;
    }


    static public function getRecord($request)
    {

        $return = self::select('product.*');
                if(!empty(Request::get('id')))
                {
                    $return = $return->where('product.id', '=', Request::get('id'));
                }

                if(!empty(Request::get('title')))
                {
                    $return = $return->where('product.title','like','%'.Request::get('title').'%');
                }

                if(!empty(Request::get('sku')))
                {
                    $return = $return->where('product.sku','like','%'.Request::get('sku').'%');
                }

                if(!empty(Request::get('is_public'))){
                    $status = Request::get('is_public');
                    if (Request::get('is_public') == '1000') {
                        $status = '0';
                    }
                    $return = $return->where('product.is_public', '=', $status);
                }
               
                $return = $return->orderBy('product.id', 'desc')
                ->paginate(50);

        return $return;

       // return self::orderBy('id','desc')->paginate(25);
    }

    static public function getHomeFeatured($request)
    {

        if (\Session::has('rand.home')) {
            $seed = \Session::get('rand.home');
        } else {
            $seed = rand(9999, 999999);
            \Session::put('rand.home', $seed);
        }

        return self::where('is_public', '=', 0)
                ->where('is_delete', '=', 0)
                ->where('is_featured', '=', 1)
                ->orderBy(DB::raw('RAND("' . $seed . '")'))
                ->groupBy('product.id')
                ->paginate(40);   
    }

    static public function getFrontProduct_old($request, $category)
    {   
        if (\Session::has('rand.key')) {
            $seed = \Session::get('rand.key');
        } else {
            $seed = rand(9999, 999999);
            \Session::put('rand.key', $seed);
        }


        $return = self::select('product.*')
                ->join('category','category.id','=','product.category_id')
                ->where('product.is_public', '=', 0)
                ->where('product.is_delete', '=', 0);
                if(!empty($category))
                {
                    $return = $return->whereIn('category.id', $category);
                }

                if(!empty(Request::get('sort')))
                {
                    $sort = Request::get('sort');
                    if($sort == 'most_recent')
                    {
                        $return = $return->orderBy('product.id','desc');   
                    }
                    else if($sort == 'lowest_price')
                    {
                        $return = $return->orderBy('product.price','asc');   
                    }
                    else if($sort == 'highest_price')
                    {
                        $return = $return->orderBy('product.price','desc');              
                    }
                }
                else
                {
                    $return = $return->orderBy(DB::raw('RAND("' . $seed . '")'));
                }
                $return = $return->groupBy('product.id');
                $return = $return->paginate(40);   
        return $return;
    }

    static public function ProductCatalogue()
    {
         $return = self::select('product.*')
                ->where('product.is_public', '=', 0)
                ->where('product.is_delete', '=', 0);
                $return = $return->get();   
        return $return;
    }


    static public function getFrontProduct($request, $category = [])
    {
        $seed = \Session::get('rand.key', rand(9999, 999999));
        \Session::put('rand.key', $seed);

        $query = self::select('product.*')
                     ->join('category','category.id','=','product.category_id')
                     ->where('product.is_public', 0)
                     ->where('product.is_delete', 0);

        // Category filter
        $filterSlugs = $request->input('category', []);
        

        if(!empty($filterSlugs)) {
            $categoryIds = CategoryModel::whereIn('slug', $filterSlugs)->pluck('id')->toArray();
            if(!empty($categoryIds)) 
            {
                $allids = array();
                foreach($categoryIds as $cat_id)
                {
                    $categoryAllIds = CategoryModel::getParentCategory($cat_id);
                    foreach($categoryAllIds as $sub_cat_id)
                    {
                        $allids[] = $sub_cat_id->id;
                    }
                }

                if(!empty($allids))
                {
                    $query->whereIn('product.category_id', $allids);    
                }
                else
                {
                    $query->whereIn('product.category_id', $categoryIds);    
                }
            }
        } 
        else if(!empty($category)) 
        {
            $query->whereIn('product.category_id', $category);
        }

        // Price filter
      
        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');

        if ($priceMin !== null && $priceMax !== null) {
            $query->whereBetween('product.price', [(float)$priceMin, (float)$priceMax]);
        }

         $size = $request->input('size');
        if (!empty($size)) {
            $query->join('product_size', 'product_size.product_id', '=', 'product.id')
                  ->where('product_size.name', $size);
        }

        $color = $request->input('color');
        if (!empty($color)) {
            $query->join('product_color', 'product_color.product_id', '=', 'product.id')
                  ->where('product_color.name', $color);
        }


        // Sorting
        $sort = $request->get('sort');
        if($sort == 'most_recent') {
            $query->orderBy('product.id','desc');   
        } elseif($sort == 'lowest_price') {
            $query->orderBy('product.price','asc');   
        } elseif($sort == 'highest_price') {
            $query->orderBy('product.price','desc');              
        } else {
            $query->orderBy(DB::raw('RAND("' . $seed . '")'));
        }

        $query->groupBy('product.id');
        return $query->paginate(40);
    }

// In ProductModel.php
    public function sizes()
    {
        return $this->hasMany(ProductSizeModel::class, 'product_id', 'id')->where('is_delete', 0);
    }


    static public function getFrontProduct_catgg($request, $category = [])
    {
        if (\Session::has('rand.key')) {
            $seed = \Session::get('rand.key');
        } else {
            $seed = rand(9999, 999999);
            \Session::put('rand.key', $seed);
        }

        $query = self::select('product.*')
                     ->join('category','category.id','=','product.category_id')
                     ->where('product.is_public', 0)
                     ->where('product.is_delete', 0);

        // Convert category slugs to IDs if passed from request
        $filterSlugs = $request->input('category', []);
        if(!empty($filterSlugs)) {
            $categoryIds = \App\Models\CategoryModel::whereIn('slug', $filterSlugs)->pluck('id')->toArray();
            if(!empty($categoryIds)) {
                $query->whereIn('product.category_id', $categoryIds);
            }
        } else if(!empty($category)) {
            $query->whereIn('product.category_id', $category);
        }

        // Sorting
        $sort = $request->get('sort');
        if($sort == 'most_recent') {
            $query->orderBy('product.id','desc');   
        } elseif($sort == 'lowest_price') {
            $query->orderBy('product.price','asc');   
        } elseif($sort == 'highest_price') {
            $query->orderBy('product.price','desc');              
        } else {
            $query->orderBy(DB::raw('RAND("' . $seed . '")'));
        }

        $query->groupBy('product.id');
        return $query->paginate(40);
    }



    static public function getProductCounts()
    {
        return self::select('category_id', DB::raw('COUNT(*) as total'))
        ->where('is_public', 0)
        ->where('is_delete', 0)
        ->groupBy('category_id')
        ->pluck('total', 'category_id')
        ->toArray();
    }

    static public function getSearchProduct($request)
    {   
        if (\Session::has('rand.search')) {
            $seed = \Session::get('rand.search');
        } else {
            $seed = rand(9999, 999999);
            \Session::put('rand.search', $seed);
        }


        $return = self::select('product.*')
                ->join('category','category.id','=','product.category_id')
                ->where('product.is_public', '=', 0)
                ->where('product.is_delete', '=', 0);
                if(!empty($request->search))
                {
                    $search = $request->search;
                    $return = $return->orWhere(function ($query) use ($search) {
                        $query = $query->where('category.name','LIKE', '%'.$search.'%')
                            ->orWhere('product.title', 'LIKE', '%'.$search.'%');
                    });                
                }
                $return = $return->groupBy('product.id');
                $return = $return->paginate(40);   
        return $return;
    }

    public function getURL()
    {
        return url('item/'.$this->slug);
    }

    public function category() {
        return $this->belongsTo(CategoryModel::class, "category_id", "id");
    }


    // get get color
    public function getcolor() {
        return $this->hasMany(ProductColorModel::class, "product_id")->where('product_color.is_delete', 0)->orderBy('id', 'asc');
    }

    // get get size
    public function getsize() {
        return $this->hasMany(ProductSizeModel::class, "product_id")->where('product_size.is_delete','=', 0)->orderBy('id', 'asc');
    }


    // get product images
    public function image() {
        return $this->hasMany(ProductImageModel::class, "product_id")->orderBy('id', 'asc');
    }

    //   get default one image
    public function defaultPhoto() {
        return $this->belongsTo(ProductImageModel::class, "id", "product_id")->orderBy('id', 'asc')->limit(1);
    }

    public function photo() {
        if ($this->defaultPhoto && !empty($this->defaultPhoto->small) && file_exists('upload/' . $this->id . '/' . $this->defaultPhoto->small)) {
            return url('upload/' . $this->id . '/' . $this->defaultPhoto->small);
        } else {
            return '';
        }
    }

    public function photobig() {
        if ($this->defaultPhoto && !empty($this->defaultPhoto->name) && file_exists('upload/' . $this->id . '/' . $this->defaultPhoto->name)) {
            return url('upload/' . $this->id . '/' . $this->defaultPhoto->name);
        } else {
            return '';
        }
    }

    public function userwishlist()
    {
        return  UsersWishlistModel::where('product_id','=',$this->id)->where('user_id','=',Auth::user()->id)->count();
    }
    

    public function wishlistcount()
    {
        return  UsersWishlistModel::where('product_id','=',$this->id)->count();
    }
    
    // get video
    public function getVideoFile(){
        if (!empty($this->video_file) && file_exists('upload/' . $this->id . '/' . $this->video_file)) {
            return url('upload/' . $this->id . '/' . $this->video_file);
        } else {
            return '';
        }
    } 


    static public function getFrontProductsHomeNewArrival()
    {   
        if (\Session::has('rand.key')) {
            $seed = \Session::get('rand.key');
        } else {
            $seed = rand(9999, 999999);
            \Session::put('rand.key', $seed);
        }


        $return = self::select('product.*')
                ->join('category','category.id','=','product.category_id')
                ->where('product.is_new_arrival', '=', 1)
                ->where('product.is_public', '=', 0)
                ->where('product.is_delete', '=', 0);
                $return = $return->orderBy(DB::raw('RAND("' . $seed . '")'));
                $return = $return->groupBy('product.id');
                $return = $return->paginate(40);   
        return $return;
    }


    static public function getFrontProductsHomeBestSelling()
    {   
        if (\Session::has('rand.key')) {
            $seed = \Session::get('rand.key');
        } else {
            $seed = rand(9999, 999999);
            \Session::put('rand.key', $seed);
        }


        $return = self::select('product.*')
                ->join('category','category.id','=','product.category_id')
                ->where('product.is_best_selling', '=', 1)
                ->where('product.is_public', '=', 0)
                ->where('product.is_delete', '=', 0);
                $return = $return->orderBy(DB::raw('RAND("' . $seed . '")'));
              
                $return = $return->groupBy('product.id');
                $return = $return->paginate(40);   
        return $return;
    }

    static public function getFrontProductsHomeFeatured()
    {   
        if (\Session::has('rand.key')) {
            $seed = \Session::get('rand.key');
        } else {
            $seed = rand(9999, 999999);
            \Session::put('rand.key', $seed);
        }


        $return = self::select('product.*')
                ->join('category','category.id','=','product.category_id')
                ->where('product.is_featured', '=', 1)
                ->where('product.is_public', '=', 0)
                ->where('product.is_delete', '=', 0);
                $return = $return->orderBy(DB::raw('RAND("' . $seed . '")'));
                $return = $return->groupBy('product.id');
                $return = $return->paginate(40);   
        return $return;
    }

    static public function getFrontProductsApp()
    {   

        if (\Session::has('rand.key')) {
            $seed = \Session::get('rand.key');
        } else {
            $seed = rand(9999, 999999);
            \Session::put('rand.key', $seed);
        }


        $return = self::select('product.*')
                ->join('category','category.id','=','product.category_id')
                ->where('product.is_featured', '=', 1)
                ->where('product.is_public', '=', 0)
                ->where('product.is_delete', '=', 0);
                $return = $return->orderBy(DB::raw('RAND("' . $seed . '")'));
                $return = $return->groupBy('product.id');
                $return = $return->paginate(16);  
        return $return;
    }



}


