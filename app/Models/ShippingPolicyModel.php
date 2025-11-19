<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingPolicyModel extends Model
{
    use HasFactory;

    protected $table = "shipping_policy";

    static function get_single($id)
    {
        return self::find($id);
    }
}



