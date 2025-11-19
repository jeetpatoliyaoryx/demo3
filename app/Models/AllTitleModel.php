<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllTitleModel extends Model
{
    use HasFactory;

    protected $table = "all_title";

    static function get_single($id)
    {
        return self::find($id);
    }
}