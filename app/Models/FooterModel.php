<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterModel extends Model
{
    use HasFactory;

    protected $table = "footer";

    static function get_single($id)
    {
        return self::find($id);
    }

 

}