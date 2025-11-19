<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingKeyModel extends Model
{
    use HasFactory;

    protected $table = "marketing_key";

    static function get_single($id)
    {
        return self::find($id);
    }

}