<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorModel extends Model
{
    use HasFactory;

    protected $table = "color";

    static function get_single($id)
    {
        return self::find($id);
    }

    static public function getColor()
    {
        return self::orderBy('id','desc')->get();
    }

    static public function getColorHome()
    {
        return self::orderBy('id','asc')->where('status','=',0)->get();   
    }
}
