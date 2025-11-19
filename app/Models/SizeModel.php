<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeModel extends Model
{
    use HasFactory;


   protected $table = "size";

    static function get_single($id)
    {
        return self::find($id);
    }

    static function getRecord()
    {
        return self::orderBy('id','desc')->get();   
    }

    static public function getSize()
    {
        return self::orderBy('id','asc')->where('status','=',0)->get();   
    }

    
}
