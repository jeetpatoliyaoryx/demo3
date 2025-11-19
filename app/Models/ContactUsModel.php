<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsModel extends Model
{
    use HasFactory;

    protected $table = "contact_us";

    static function get_single($id)
    {
        return self::find($id);
    }

     static public function getRecord()
    {
        return self::orderBy('id','desc')->paginate(25);
    }
}