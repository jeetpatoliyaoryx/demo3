<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnRefundModel extends Model
{
    use HasFactory;

    protected $table = "return_refund";

    static function get_single($id)
    {
        return self::find($id);
    }
}