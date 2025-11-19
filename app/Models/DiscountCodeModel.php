<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCodeModel extends Model
{
    use HasFactory;

    protected $table = "discount_code";

     static public function CheckDiscount($discount_code)
    {
        return self::select('discount_code.*')
                ->where('discount_code.discount_code', '=', $discount_code)
                ->first();
    }
}
