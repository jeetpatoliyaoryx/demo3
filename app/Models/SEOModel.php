<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SEOModel extends Model
{
    use HasFactory;

    protected $table = "seo";

    static function get_slug($slug)
    {
        return self::where('slug','=',$slug)->first();
    }

    static function get_single($id)
    {
        return self::find($id);
    }

    static function getRecord()
    {
        return self::orderBy('id','desc')->get();   
    }

    static public function getSeo()
    {
        return self::orderBy('id','asc')->where('status','=',0)->get();   
    }


}
