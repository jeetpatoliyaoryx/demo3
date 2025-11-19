<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizeModel extends Model
{
    use HasFactory;

    protected $table = "product_size";

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
}
