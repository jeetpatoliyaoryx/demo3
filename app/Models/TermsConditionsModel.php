<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsConditionsModel extends Model
{
    use HasFactory;

    protected $table = "terms_conditions";

    static function get_single($id)
    {
        return self::find($id);
    }
}



