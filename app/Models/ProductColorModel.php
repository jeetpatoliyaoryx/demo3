<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColorModel extends Model
{
    use HasFactory;

    protected $table = "product_color";

    static public function get_signal($id)
    {
        return self::find($id);
    }

     static public function get_single($id)
    {
        return self::find($id);
    }

    


    static public function getRecord($product_id)
    {
        return self::where('is_delete','=', 0)->where('product_id', '=', $product_id)->get();
    }

    public function options() {

        return $this->belongsTo(ProductModel::class, "product_id");
        
    }

    //  public function options()
    // {
    //     return $this->belongsTo(ProductModel::class, 'product_id');
    // }


}
