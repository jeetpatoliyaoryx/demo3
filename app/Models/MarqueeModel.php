<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarqueeModel extends Model
{
    use HasFactory;

    protected $table = "marquee";

    static function get_single($id)
    {
        return self::find($id);
    }

}