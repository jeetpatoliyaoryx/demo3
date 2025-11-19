<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialModel extends Model
{
    use HasFactory;

    protected $table = "social";

    static function get_single($id)
    {
        return self::find($id);
    }
}