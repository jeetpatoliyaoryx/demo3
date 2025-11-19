<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutAddModel extends Model
{
    use HasFactory;

    protected $table = "about_add";

    static function get_single($id)
    {
        return self::find($id);
    }
}