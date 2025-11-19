<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class CatalogueProductModel extends Model
{
    use HasFactory;

    protected $table = "catalogue_product";

    static function get_single($id)
    {
        return self::find($id);
    }


    static public function getFrontCatalogue($id)
    {   
        if (\Session::has('rand.key')) {
            $seed = \Session::get('rand.key');
        } else {
            $seed = rand(9999, 999999);
            \Session::put('rand.key', $seed);
        }


        $return = self::select('catalogue_product.*','product.title')
                ->join('product','product.id','=','catalogue_product.product_id')
                ->join('category','category.id','=','product.category_id')
                ->where('product.is_public', '=', 0)
                ->where('product.is_delete', '=', 0);
                $return = $return->orderBy(DB::raw('RAND("' . $seed . '")'));
                $return = $return->where('catalogue_product.catalogue_id', '=', $id)->get();
        return $return;
    }

}